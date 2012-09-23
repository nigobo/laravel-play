<?php

class Base_Controller extends Controller {

	public function __construct(){

		# Assets
		Asset::add('bootstrap-css', 'media/css/bootstrap.min.css');
        Asset::add('style', 'media/css/style.css');

	}

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters)
	{
		return Response::error('404');
	}

	/**
	 * Function for returning valid data for selecboxes
	 */
	public function get_selectbox_array($o,$id,$value)
	{
			
		$r[0] = "Välj...";
		foreach ($o as $p)
		{
		     $r[$p->{$id}] = $p->{$value};
		}
		return $r;

	}

}