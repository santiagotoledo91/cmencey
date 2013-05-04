<?php

class Base_Controller extends Controller {

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	
	public $layout = 'layouts.default';
	
	public function __construct() 
	{
		parent::__construct();
		$this->layout->title = 'Construcciones Mencey, C.A';
		$this->layout->header = View::make('inc.default.header');
		$this->layout->footer = View::make('inc.default.footer');
	}

	public function __call($method, $parameters)
	{
		return Response::error('404');
	}

}