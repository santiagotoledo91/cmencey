<?php

class Admin_controller extends Base_Controller {

	public function action_index () 
	{
		$view = View::make('admin.index');
		$this->layout->content = $view;
	}
}