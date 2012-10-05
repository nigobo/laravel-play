<?php

class Customer extends Eloquent
{
    /**
     * Create Customer rule set
     */
    public static $rules = array(
        'name' => 'required|min:2|max:128',
        'description' => 'required'
    );

    /**
     * Create base validationfuncion
     */
    public static function validate($data){
        return Validator::make($data, static::$rules);
    }

    /**
     * One customer belongs to only one organization
     */
    public function organization()
    {
        return $this->belongs_to('Organization');
    }

    /**
     * One customer can have many projects
     */
    public function projects(){
        return $this->has_many('Project');
    }

    public function todos(){
        return $this->has_many('Todo');
    }
}