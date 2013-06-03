<?php

class Admin_Home_Controller extends Base_Controller
{
	public function __construct() 
	{
		parent::__construct();

		$this->title = 'Sistema de gestion de personal';
	}

	public function action_index () 
	{
		$title = $this->title.' - Inicio';

		return View::make('admin.home.index')->with('title',$title);
	}
}