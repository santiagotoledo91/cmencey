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
		$received_loans 	= Input::get('received_loans');
		$startdate 			= Input::get('startdate');
		
		// calculates the stop day by adding 6 days (weekly paysheet).
		$stopdate 			= strtotime(date("Y-m-d", strtotime($startdate)). "+6 days");
		$stopdate  			= date("Y-m-d",$stopdate);

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
				$employee->extra_hours 			= round($extra_hours[$id],2); 
				$employee->production_bonus 	= round($production_bonus[$id],2);
				$employee->others 				= round($others[$id],2);
				$employee->extra_raws 			= round(($employee->extra_raws + $extra_raws[$id]),2);
				$employee->sso 					= round((0.045 	* ($employee->salary * 7)),2);
				$employee->forced_stop 			= round((0.005 	* ($employee->salary * 7)),2);
				$employee->faov 				= round((0.01 	* ($employee->salary * 7)),2);
				$employee->received_loans 		= round($received_loans[$id],2);

				$employee->accrued_total 		= round((($employee->salary * 7) + ($employee->feeding_bonus + $employee->extra_hours + $employee->production_bonus + $employee->others + $employee->extra_raws)),2);
				$employee->net_total 			= round(($employee->accrued_total - ($employee->sso + $employee->forced_stop + $employee->faov + $employee->received_loans)),2); 

				// inserts the object in the array with the id as key
				$employees[$id] = $employee;

				// total to pay
				$total = round(($total + $employee->net_total),2);
			}
		}

		Session::put('total',		$total);
		Session::put('startdate',	$startdate);	
		Session::put('stopdate',	$stopdate);
		Session::put('employees',	$employees);

		$view = View::make('admin.paysheets.view');

		$view->total 			= $total;
		$view->startdate 		= $startdate;
		$view->stopdate 		= $stopdate;
		$view->employees 		= $employees;

		$this->layout->content 	= $view;
	}

	public function post_save()
	{
		$total 		= Session::get('total');
		$startdate	= Session::get('startdate');
		$stopdate 	= Session::get('stopdate');
		$employees 	= Session::get('employees');

		// registers the new paysheet 
		$paysheet = new Paysheet;

		$paysheet->total 		= $total;
		$paysheet->startdate 	= $startdate; 
		$paysheet->stopdate 	= $stopdate ; 

		$paysheet->save();

		$paysheet = Paysheet::where('startdate','=',$startdate)->first();

		// registers the new paysheet payments of the employees
		foreach ($employees as $employee) 
		{
			$payment = new PaymentPaysheet;

			$payment->employee_id 		= $employee->id;
			$payment->paysheet_id 		= $paysheet->id;
			$payment->weekly_salary		= $employee->salary * 7;
			$payment->mo 				= $employee->mo;
			$payment->tu 				= $employee->tu;
			$payment->we 				= $employee->we;
			$payment->th 				= $employee->th;
			$payment->fr 				= $employee->fr;
			$payment->sa 				= $employee->sa;
			$payment->su 				= $employee->su;
			$payment->feeding_bonus 	= $employee->feeding_bonus;
			$payment->extra_hours		= $employee->extra_hours;
			$payment->production_bonus 	= $employee->production_bonus;
			$payment->extra_raws		= $employee->extra_raws;
			$payment->others 			= $employee->others;
			$payment->accrued_total		= $employee->accrued_total;
			$payment->sso 				= $employee->sso;
			$payment->faov 				= $employee->faov;
			$payment->forced_stop 		= $employee->forced_stop;
			$payment->received_loans 	= $employee->received_loans;
			$payment->net_total			= $employee->net_total;

			$payment->save();
		}
		return Redirect::to('admin/print/paysheet/'.$paysheet->id);
	}
}