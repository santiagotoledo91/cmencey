<?php

class Admin_Roles_Controller extends Base_Controller
{
	public $layout = 'layouts.admin';
	public $restful = true;

	public function get_add()
	{
		$this->layout->title .= ' - Añadir Cargo.';

		$view = View::make('admin.roles.add');

		$this->layout->content = $view;
	}

	public function post_add()
	{
		$role = New role();

		$role->name 	= Input::get('name');
		$role->salary 	= Input::get('salary');
		
		$role->save();

		return Redirect::to('admin');
	}
}