<?php

class Login_Controller extends Base_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->filter('before', 'auth')->except(array('login','do_login'));
	}

	public function action_login()
	{
		return View::make('login.login');
	}

	public function action_do_login()
	{
		$userdata = array(
		        'username' => Input::get('username'),
		        'password' => Input::get('password')
	    );

	    if ( Auth::attempt($userdata) ) {
	        return Redirect::to('/');
	    }else{
	        return Redirect::to('/login')
	        ->with('login_errors', true);
	    }

	}

	public function action_logout()
	{
		Auth::logout();
		return Redirect::to('/');
	}
}