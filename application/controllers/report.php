<?php

class Report_Controller extends Base_Controller {

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

	public function action_index()
	{
		$reports = Report::with('user')->all();
    	return View::make('pages.reports')
        	->with('reports',$reports);
	}

	public function action_view($post)
	{
		// this is our single view
		$post = Post::find($post);
		return View::make('pages.view')
			->with('post',$post);
	}

	public function action_edit($post)
	{
		// this is our single view
		
		return View::make('pages.report_edit');
	}

	public function action_create()
	{
		// this is our single view
		return View::make('pages.report_create');
	}
	
	public function action_do_create()
	{
		// let's get the new post from the POST data
	    // this is much safer than using mass assignment
	    $new_report = array(
	        'date' => Input::get('date'),
	        'description' => Input::get('description'),
	        'time_spent' => Input::get('time_spent')
	        
	    );

	    // let's setup some rules for our new data
	    // I'm sure you can come up with better ones
	    // 2012-12-12
	    $rules = array(
	        'date' => 'required|min:10|max:10',
	        'time_spent' => 'required|min:0|max:10',
	        'description' => 'required'
	    );

	    // make the validator
	    $v = Validator::make($new_report, $rules);
	    if ( $v->fails() )
	    {
	        // redirect back to the form with
	        // errors, input and our currently
	        // logged in user
	        return Redirect::to('report/create')
	        ->with('user', Auth::user())
	        ->with_errors($v)
	        ->with_input();
	    }

	    // create the new post
	    $report = new Report($new_report);
	    $report->save();
	    // redirect to viewing our new post
	    return Redirect::to('report');
		
	}

}