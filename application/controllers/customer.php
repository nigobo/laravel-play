<?php

class Customer_Controller extends Base_Controller {

	/*
	|--------------------------------------------------------------------------
	| The Default Controller
	|--------------------------------------------------------------------------
	|
	| Instead of using RESTful routes and anonymous functions, you might wish
	| to use controllers to organize your application API. You'll love them.
	|
	| This controller responds to URIs beginning with "home", and it also
	| serves as the default controller for the application, meaning it
	| handles requests to the root of the application.
	|
	| You can respond to GET requests to "/home/profile" like so:
	|
	|		public function action_profile()
	|		{
	|			return "This is your profile!";
	|		}
	|
	| Any extra segments are passed to the method as parameters:
	|
	|		public function action_profile($id)
	|		{
	|			return "This is the profile for user {$id}.";
	|		}
	|
	*/

	public function __construct()
	{	
		parent::__construct();
		$this->filter('before', 'auth');
	}

	public function action_index()
	{

		return View::make('customer.index')
        	->with('customers',Customer::with('projects')->all());
	}

	public function action_create()
	{
	
		return View::make('customer.create');
	}

	public function action_do_create()
	{
		
		$v = Customer::validate(Input::all());

	    if ( $v->fails() ){
	        return Redirect::to_route('create_customer')
	        ->with('user', Auth::user())
	        ->with_errors($v)
	        ->with_input();
	    }

		$new_customer = array(
	        'name' => Input::get('name'),
	        'description' => Input::get('description'),
	        'organization_id' => Auth::user()->organization->id	    
	    );

	    $customer = new Customer($new_customer);
	    $customer->save();

	    return Redirect::to_route('customers');
		
	}
	
	
}