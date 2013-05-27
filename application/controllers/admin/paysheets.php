<?php

class Admin_Paysheets_Controller extends Base_Controller 
{
	public $layout = 'layouts.admin';
	public $restful = true;

	public function __construct() 
	{
		parent::__construct();

		$this->layout->title = 'Sistema de gestion de personal';
	}

	public function get_pre() 
	{
		$this->layout->title .= ' - Pre-nómina.';

		$view = View::make('admin.paysheets.pre');
		
		$view->employees = Employee::where('active','=','1')->get();

		$this->layout->content = $view;	

	}

	public function post_view()
	{
		$total = 0;
		
		$id = Input::get('id');

		$include = Input::get('include');

		// creates an array of objects with the employee paysheet properties
		foreach ($id as $id)
		{
			if (isset($include[$id])) 
			{ 
				$employee = Employee::find($id);

				$employee->sso 				= 0.045 * ($employee->salary / 4);
				$employee->forced_stop 		= 0.005 * ($employee->salary / 4);
				$employee->faov 			= 0.01 	* ($employee->salary / 4);
				$employee->bonus_feeding 	= 76*0.55*5;
			
				$employee->total =  (($employee->salary / 4) + (($employee->salary / 28) * $employee->extra)) - ($employee->sso + $employee->forced_stop + $employee->faov) + $employee->bonus_feeding ;

				// inserts the info in the array
				$employees[$id] = $employee;

				// total to pay
				$total = $total + $employee->total;
			}
		}

		$view = View::make('admin.paysheets.view');

		$view->total = $total;
		
		$view->employees = $employees;

		$this->layout->content = $view;
	}
}