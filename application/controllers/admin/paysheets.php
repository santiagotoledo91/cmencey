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
		$total 				= 0;
		$id 				= Input::get('id');
		$include 			= Input::get('include');
		$mo					= Input::get('mo');
		$tu 				= Input::get('tu');
		$we 				= Input::get('we');
		$th 				= Input::get('th');
		$fr 				= Input::get('fr');
		$sa 				= Input::get('sa');
		$su 				= Input::get('su');
		$extra_hours 		= Input::get('extra_hours');
		$production_bonus 	= Input::get('production_bonus');
		$others 			= Input::get('others');
		$extra_raws 		= Input::get('extra_raws');
		$recieved_loans 	= Input::get('recieved_loans');
		
		// creates an array of objects with the employee paysheet properties
		foreach ($id as $id)
		{
			// determines if the employee will be included in the paysheet or not
			if (isset($include[$id])) 
			{ 
				// loads the employee basic information
				$employee = Employee::find($id);

				// determines which days has been worked
				if (isset($mo[$id])) { $employee->mo = 1; } else { $employee->mo = 0; }
				if (isset($tu[$id])) { $employee->tu = 1; } else { $employee->tu = 0; }
				if (isset($we[$id])) { $employee->we = 1; } else { $employee->we = 0; }
				if (isset($th[$id])) { $employee->th = 1; } else { $employee->th = 0; }
				if (isset($fr[$id])) { $employee->fr = 1; } else { $employee->fr = 0; }
				if (isset($sa[$id])) { $employee->sa = 1; $employee->extra_raws = $employee->extra_raws + 150; } else { $employee->sa = 0; }
				if (isset($su[$id])) { $employee->su = 1; $employee->extra_raws = $employee->extra_raws + 150; } else { $employee->su = 0; }
	
				$employee->worked = $employee->mo + $employee->tu + $employee->we + $employee->th + $employee->fr + $employee->sa + $employee->su;
 
				$employee->feeding_bonus 		= 65 * $employee->worked;
				$employee->extra_hours 			= $extra_hours[$id]; 
				$employee->production_bonus 	= $production_bonus[$id];
				$employee->others 				= $others[$id];
				$employee->extra_raws 			= $employee->extra_raws + $extra_raws[$id];
				$employee->sso 					= 0.045 * ($employee->salary * 7);
				$employee->forced_stop 			= 0.005 * ($employee->salary * 7);
				$employee->faov 				= 0.01 	* ($employee->salary * 7);
				$employee->recieved_loans 		= $recieved_loans[$id];

				$employee->total =  ($employee->salary * 7)
									+
									($employee->feeding_bonus + $employee->extra_hours + $employee->production_bonus + $employee->others + $employee->extra_raws) 
									- 
									($employee->sso + $employee->forced_stop + $employee->faov + $employee->recieved_loans); 

				// inserts the object in the array with the id as key
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

	public function post_save()
	{
		
	}
}