<?php

class Base_Controller extends Controller {

	public $layout = 'layouts.default';
	
	public function __construct() 
	{
		parent::__construct();
		
		$this->layout->title = 'Construcciones Mencey, C.A';
			
		Asset::add('responsive.css','css/bootstrap-responsive.css');
		Asset::add('bootstrap.css','css/bootstrap.css');

		Asset::add('bootstrap.js','js/bootstrap.js');
	}

	public function __call($method, $parameters)
	{
		return Response::error('404');
	}

}