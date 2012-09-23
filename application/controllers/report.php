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
		$per_page = 5;
		$reports = Report::with('project')->order_by('date','desc')->paginate($per_page);
		
		return View::make('report.index')
        	->with('reports',$reports);
	}

	public function action_read($post)
	{
		// this is our single view
		$post = Post::find($post);
		return View::make('report.read')
			->with('post',$post);
	}

	public function action_update($id)
	{
	
		$projects = DB::table('projects')->order_by('name','asc')->get();

		$report = Report::find($id);

		return View::make('report.update')
			->with('report',$report)
			->with('projects',$this->get_selectbox_array($projects,"id","name"));

	}

	public function action_create()
	{
	
		$report = new Report();
		$projects = DB::table('projects')->order_by('name','asc')->get();

		return View::make('report.create')
			->with('report',$report)
			->with('projects',$this->get_selectbox_array($projects,"id","name"));
	}
	
	public function action_do_create()
	{
		
		$user = Auth::user();

		$v = Report::validate(Input::all());
	    if ( $v->fails() )
	    {
	        return Redirect::to('report/create')
	        ->with('user', Auth::user())
	        ->with_errors($v)
	        ->with_input();
	    }

		$new_report = array(
	        'date' => Input::get('date'),
	        'description' => Input::get('description'),
	        'time_spent' => Input::get('time_spent'),
	        'project_id' => Input::get('project_id'),
	        'user_id' => $user->id
	    );

	    $report = new Report($new_report);
	    $report->save();

	    return Redirect::to('report');
		
	}
	
	public function action_do_update()
	{

		$report = Report::find(Input::get('report_id'));

		$user = Auth::user();

		$v = Report::validate(Input::all());
	    if ( $v->fails() )
	    {
	        return Redirect::to_route('update_report',Input::get('report_id'))
	        ->with('user', Auth::user())
	        ->with_errors($v)
	        ->with_input();
	    }

	    $report->date = Input::get('date');
	    $report->description = Input::get('description');
	    $report->time_spent = Input::get('time_spent');
	    $report->project_id = Input::get('project_id');

	    $report->save();

	    return Redirect::to('report');
		
	}

}