<?php

class Admin_Home_Controller extends Base_Controller
{
	public $layout = 'layouts.admin';

	public function __construct() 
	{
		parent::__construct();
		
		$this->layout->title = 'Sistema de gestion de personal';
	}

	public function action_index () 
	{
		$view = View::make('admin.home.index');
		$this->layout->content = $view;
	}
}