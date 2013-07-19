<?php 

class Admin_Auth_Controller extends Base_Controller 
{
	public $restful = true;
	
	public function __construct() 
	{
		parent::__construct();

		$this->title = 'Construcciones Mencey, C.A';
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
		// get the input fields
		$input["username"] = Input::get('username');
		$input["password"] = Input::get('password');

		// set the validation rules
		$rules = array(
				'username'	=> array('required','max:15'),
				'password'	=> 'required'
			);

		// set the custom messages
		$messages = array(
			'required' => 'Campo Obligatorio',
		);

		// validates the data
		$validation = Validator::make($input, $rules,$messages);
 
		// validation failed
		if ($validation->fails()) 
		{
			return Redirect::to('admin/login')->with_errors($validation);
		} 
		// validation passed
		else  
		{
			$username 		= Input::get('username');
			$password 		= Input::get('password');
			$cretendials 	= array('username' => $username, 'password' => $password);

			if (Auth::attempt($cretendials)) 
			{
				return Redirect::to('/');
			} 
			else 
			{
				// creates a new message with the object format
				$messages = new \Laravel\Messages;

				// adds the message
				$messages->add('auth','Usuario o Contraseña Incorrectos');

				// redirects with the error
				return Redirect::to('admin/login')->with_errors($messages);
			}
		}
	}

	public function get_logout()
	{
		Auth::logout();
		return Redirect::to('admin');
	}
}