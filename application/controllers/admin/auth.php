<?php 

class Admin_Auth_Controller extends Base_Controller 
{
	public $restful = true;
	
	public function __construct() 
	{
		parent::__construct();

		$this->title = 'Sistema de gestion de personal';
	}
	
	public function get_login() 
	{
		$title = $this->title.' - Inicio de sesion.';

		// if the user is already logged then redirects to the admin page
		if (Auth::check()) 
		{
			return Redirect::to('admin');
		}
		// if the user is not logged in then loads the login form
		else 
		{
			return View::make('admin.auth.login')->with('title',$title);
		}
	}

	public function post_login()
	{
		$username = Input::get('username');
		$password = Input::get('password');

		$cretendials = array('username' => $username, 'password' => $password);

		if (Auth::attempt($cretendials))
		{
			return Redirect::to('admin');
		}
		else
		{
			return Redirect::to('admin/login');
		}
	}

	public function get_logout()
	{
		Auth::logout();
		return Redirect::to('admin');
	}
}