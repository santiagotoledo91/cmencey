<?php

class Base_Controller extends Controller {

	public $layout = 'layouts.default';
	
	public function __construct() 
	{
		parent::__construct();
		
		$this->layout->title = 'Construcciones Mencey, C.A';

		Asset::add('bootstrap.css','css/bootstrap.css');
		Asset::add('responsive.css','css/bootstrap-responsive.css');
		
		Asset::add('bootstrap.js','js/bootstrap.js');
		Asset::add('jquery.js','js/jquery.js');
		Asset::add('bootstrap-dropdown.js','js/bootstrap-dropdown.js');
		Asset::add('bootstrap-collapse.js','js/bootstrap-collapse.js');
		Asset::add('bootstrap-transition.js','js/bootstrap-transition.js');
	}

	public function __call($method, $parameters)
	{
		return Response::error('404');
	}

}