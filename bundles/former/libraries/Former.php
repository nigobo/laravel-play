<?php
/**
 *
 * Former
 *
 * Superset of Field ; helps the user interact with it and its classes
 * Various form helpers for repopulation, rules, etc.
 */
namespace Former;

class Former
{
  /**
   * The current field being worked on
   * @var Field
   */
  private static $field;

  /**
   * The current form being worked on
   * @var Form
   */
  private static $form;

  /**
   * Values populating the form
   * @var array
   */
  private static $values;

  /**
   * The form's errors
   * @var Message
   */
  private static $errors;

  /**
   * An array of rules to use
   * @var array
   */
  private static $rules = array();

  /**
   * An array of the rules usable in live validation
   * @var array
   */
  private static $supportedRules = array(
    'alpha', 'required', 'min', 'max', 'numeric', 'not_numeric',
    'between', 'in', 'not_in', 'match');

  // Former options ------------------------------------------------ /

  /**
   * A class to be added to required fields
   * @var string
   */
  public static $requiredClass = 'required';

  /**
   * Whether Former should use Bootstrap's syntax
   * @var boolean
   */
  public static $useBootstrap = true;

  /**
   * The main place where former will look for translations
   * @var string
   */
  public static $translateFrom = 'validation.attributes';

  /**
   * The default fallback form type if none specificed (Former::open)
   * @var string
   */
  public static $defaultFormType = 'horizontal';

  // Field types --------------------------------------------------- /

  /**
   * The available input sizes
   * @var array
   */
  private static $FIELD_SIZES = array(
    'mini', 'small', 'medium', 'large', 'xlarge', 'xxlarge',
    'span1', 'span2', 'span3', 'span4', 'span5', 'span6', 'span7',
    'span8', 'span9', 'span10', 'span11', 'span12');

  ////////////////////////////////////////////////////////////////////
  //////////////////////////// INTERFACE /////////////////////////////
  ////////////////////////////////////////////////////////////////////

  /**
   * Creates a field instance
   *
   * @param  string $method     The field type
   * @param  array  $parameters An array of parameters
   * @return Former
   */
  public static function __callStatic($method, $parameters)
  {
    // Form opener
    if (str_contains($method, 'open')) {
      static::$form = new Form;
      return static::form()->open($method, $parameters);
    }

    // Checking for any supplementary classes
    $classes = explode('_', $method);
    $method  = array_pop($classes);

    // Picking the right class
    if(class_exists('\Former\Fields\\'.ucfirst($method))) {
      $callClass = ucfirst($method);
    } else {
      switch ($method) {
        case 'multiselect':
          $callClass = 'Select';
          break;
        case 'checkboxes':
          $callClass = 'Checkbox';
          break;
        case 'radios':
          $callClass = 'Radio';
          break;
        default:
          $callClass = 'Input';
          break;
      }
    }

    // Listing parameters
    $class = '\Former\Fields\\'.$callClass;
    static::$field = new $class(
      $method,
      array_get($parameters, 0),
      array_get($parameters, 1),
      array_get($parameters, 2),
      array_get($parameters, 3),
      array_get($parameters, 4),
      array_get($parameters, 5)
    );

    // Inline checkboxes
    if(in_array($callClass, array('Checkbox', 'Radio')) and
      in_array('inline', $classes)) {
      static::$field->inline();
    }

    // Add any size we found
    if ($sizes = array_intersect(static::$FIELD_SIZES, $classes)) {
      $size = $sizes[key($sizes)];
      $size = starts_with($size, 'span') ? $size : 'input-'.$size;
      static::$field->addClass($size);
    }

    return new Former;
  }

  /**
   * Pass a chained method to the Field
   *
   * @param  string $method     The method to call
   * @param  array  $parameters Its parameters
   * @return Former
   */
  public function __call($method, $parameters)
  {
    $object = method_exists($this->control(), $method)
      ? $this->control()
      : static::$field;

    // Call the function on the corresponding class
    call_user_func_array(array($object, $method), $parameters);

    return $this;
  }

  /**
   * Get an attribute/value from the Field instance
   *
   * @param  string $attribute The requested attribute
   * @return string            Its value
   */
  public function __get($attribute)
  {
    return $this->field()->$attribute;
  }

  /**
   * Prints out Field wrapped in ControlGroup
   *
   * @return string A form field
   */
  public function __toString()
  {
    // Dry syntax (hidden fields, plain fields)
    if (static::$field->type == 'hidden' or
        static::form()->type == 'search' or
        static::form()->type == 'inline') {
          $html = static::$field->__toString();
    }

    // Bootstrap syntax
    elseif (static::$useBootstrap and static::form()->type) {
      $html = $this->control()->wrapField(static::$field);
    }

    // Classic syntax
    else {
      $html = \Form::label(static::$field->name, static::$field->label);
      $html .= static::$field;
    }

    // Destroy field instance
    static::$field = null;

    return $html;
  }

  ////////////////////////////////////////////////////////////////////
  //////////////////////////// TOOLKIT ///////////////////////////////
  ////////////////////////////////////////////////////////////////////

  /**
   * Add values to populate the array
   *
   * @param mixed $values Can be an Eloquent object or an array
   */
  public static function populate($values)
  {
    static::$values = $values;
  }

  /**
   * Get a value from the object/array
   *
   * @param  string $name The key to retrieve
   * @return mixed        Its value
   */
  public static function getValue($name)
  {
    return is_object(static::$values)
      ? static::$values->{$name}
      : array_get(static::$values, $name);
  }

  /**
   * Fetch a field value from both the new and old POST array
   *
   * @param  string $name     A field name
   * @param  string $fallback A fallback if nothing was found
   * @return string           The results
   */
  public static function getPost($name, $fallback = null)
  {
    return \Input::get($name, \Input::old($name, $fallback));
  }

  /**
   * Set the errors to use for validations
   *
   * @param Message $validator The result from a validation
   */
  public static function withErrors($validator)
  {
    // If we're given a raw Validator, go fetch the errors in it
    if($validator instanceof Validator) $validator = $validator->errors;

    static::$errors = $validator;
  }

  /**
   * Add live validation rules
   *
   * @param  array $rules An array of Laravel rules
   */
  public static function withRules($rules)
  {
    // Parse the rules according to Laravel conventions
    foreach ($rules as $name => $fieldRules) {
      foreach (explode('|', $fieldRules) as $rule) {

        // If we have a rule with a value
        if (($colon = strpos($rule, ':')) !== false) {
          $parameters = str_getcsv(substr($rule, $colon + 1));
       }

       // Exclude unsupported rules
       $rule = is_numeric($colon) ? substr($rule, 0, $colon) : $rule;
       if(!in_array($rule, static::$supportedRules)) continue;

       // Store processed rule in Former's array
       if(!isset($parameters)) $parameters = array();
       static::$rules[$name][$rule] = $parameters;
      }
    }
  }

  /**
   * Set the useBootstrap option
   *
   * @param  boolean $boolean Whether we should use Bootstrap syntax or not
   */
  public static function useBootstrap($boolean = true)
  {
    static::$useBootstrap = $boolean;
  }

  ////////////////////////////////////////////////////////////////////
  ////////////////////////////// BUILDERS ////////////////////////////
  ////////////////////////////////////////////////////////////////////

  /**
   * Closes a form
   *
   * @return string A form closing tag
   */
  public static function close()
  {
    $close = static::form()->close();

    // Destroy Form instance
    static::$form = null;

    return $close;
  }

  /**
   * Creates a form legend
   *
   * @param  string $legend     The text
   * @param  array  $attributes Its attributes
   * @return string             A legend tag
   */
  public static function legend($legend, $attributes = array())
  {
    $legend = Helpers::translate($legend);

    return '<legend'.\HTML::attributes($attributes).'>' .$legend. '</legend>';
  }

  /**
   * Writes the form actions
   *
   * @return string A .form-actions block
   */
  public static function actions()
  {
    $buttons = func_get_args();

    $actions  = '<div class="form-actions">';
    $actions .= is_array($buttons) ? implode(' ', $buttons) : $buttons;
    $actions .= '</div>';

    return $actions;
  }

  ////////////////////////////////////////////////////////////////////
  //////////////////////////// HELPERS ///////////////////////////////
  ////////////////////////////////////////////////////////////////////

  /**
   * Get the errors for the current field
   *
   * @param  string $name A field name
   * @return string       An error message
   */
  public static function getErrors()
  {
    if (static::$errors) {
      return static::$errors->first(static::$field->name);
    }
  }

  /**
   * Get a rule from the Rules array
   *
   * @param  string $name The field to fetch
   * @return array        An array of rules
   */
  public static function getRules($name)
  {
    return array_get(static::$rules, $name);
  }

  /**
   * Returns the current ControlGroup
   *
   * @return ControlGroup
   */
  public static function control()
  {
    if(!static::$field) return false;

    return static::$field->getControl();
  }

  /**
   * Returns the current Form
   *
   * @return Form
   */
  public static function form()
  {
    if (!static::$form) return new Form;

    return static::$form;
  }

  /**
   * Get the current field instance
   *
   * @return Field
   */
  public static function field()
  {
    if(!static::$field) return false;

    return self::$field;
  }
}
