<?php

class Project_Controller extends Base_Controller {

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
		$per_page = 5;
		$projects = Project::all();
		
		return View::make('project.index')
        	->with('projects',$projects);
	}

	public function action_view($id)
	{
		// this is our single view
		$project = Project::find($id)->with('reports');
		return View::make('project.view')
			->with('project',$project);
	}

	public function action_edit($post)
	{
		// this is our single view
		
		return View::make('pages.report_edit');
	}

	public function action_create()
	{
		#$reports = Report::with('user')->all();

		return View::make('project.create');
	}
	
	public function action_do_create()
	{

		// let's get the new post from the POST data
	    // this is much safer than using mass assignment
	    $new = array(
	        'name' => Input::get('name'),
	        'description' => Input::get('description')
	    
	    );

	    // let's setup some rules for our new data
	    // I'm sure you can come up with better ones
	    // 2012-12-12
	    $rules = array(
	        'name' => 'required|min:2|max:32',
	        'description' => 'required'

	    );


	    // make the validator
	    $v = Validator::make($new, $rules);
	    if ( $v->fails() )
	    {
	        // redirect back to the form with
	        // errors, input and our currently
	        // logged in user
	        return Redirect::to('project/create')
	        ->with('user', Auth::user())
	        ->with_errors($v)
	        ->with_input();
	    }

	    // create the new post
	    $o = new Project($new);

	    
	    $o->save();


	    // redirect to viewing our new post
	    return Redirect::to('project');
		
	}

}