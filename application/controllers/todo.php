<?php

class Todo_Controller extends Base_Controller {

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
		// Get all user organization projects
		$todos = Todo::with('reports')->get();

		return View::make('todo.index')
        	->with('todos',$todos);
	}

	public function action_read($id)
	{
		// this is our single view
		$todo = Todo::find($id)->with('reports');
		return View::make('todo.view')
			->with('todo',$todo);
	}

	public function action_edit($post)
	{
		// this is our single view
		
		return View::make('pages.report_edit');
	}

	public function action_create($project_id)
	{
		$project = Project::find($project_id);
		
		$todo = new Todo();

		return View::make('todo.create')
			->with('project',$project)
			->with('todo',$todo);
	}
	
	public function action_do_create()
	{

		$project = Project::find(Input::get('project_id'));
		
		$new = array(
	        'title' => Input::get('title'),
	        'description' => Input::get('description'),
			'customer_id' => $project->customer_id,	    
			'project_id' => $project->id,	      
			'organization_id' => Auth::user()->organization->id	
	    );
		
		$v = Todo::validate($new);

	    if ( $v->fails() )
	    {
	    	// redirect back to the form with
	        // errors, input and our currently
	        // logged in user
	        return Redirect::to_route('create_todo',$project->id)
	        ->with_errors($v)
	        ->with_input();
	    }

	    // create the new post
	    $o = new Todo($new);
	    $o->save();

	    // redirect to viewing our new post
	    return Redirect::to_route('read_customer',$project->customer_id);
		
	}

}