<?php

class Admin_Paysheets_Controller extends Base_Controller 
{
	public $restful = true;

	public function __construct() 
	{
		parent::__construct();

		$this->title = 'Sistema de gestion de personal';
	}

	public function get_pre() 
	{
		$title = $this->title .' - Prenómina.';

		$employees = Employee::where('active','=','1')->get();

		// gets the stopdate of the last paysheet 
		$paysheet = Paysheet::order_by('id','desc')->first();
		
		// adds 1 day to generate the new paysheet startdate only if there is a previous paysheet
		if (!empty($paysheet))
		{
			$startdate	= strtotime(date("Y-m-d", strtotime($paysheet->stopdate)). "+1 days");
			$startdate	= date("Y-m-d",$startdate);
		} 
		else
		{
			$startdate = null;
		}	

		return View::make('admin.paysheets.pre')->with('title',$title)->with('employees',$employees)->with('startdate',$startdate);
	}

	public function post_view()
	{
		$title = $this->title.' - Vista preliminar de nomina';

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
				$employee->inces 				= round((0.005  * ($employee->salary * 7)),2);
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

		return View::make('admin.paysheets.view')->with('title',$title)->with('total',$total)->with('startdate',$startdate)->with('stopdate',$stopdate)->with('employees',$employees);
	}

	public function post_save()
	{
		$total 		= Session::get('total');
		$startdate	= Session::get('startdate');
		$stopdate 	= Session::get('stopdate');
		$employees 	= Session::get('employees');

		$lastpaysheet = Paysheet::order_by('id','desc')->first();

		if ($lastpaysheet == null or $startdate > $lastpaysheet->stopdate)
		{
			// registers the new paysheet 
			$paysheet = new Paysheet;

			$paysheet->total 		= $total;
			$paysheet->startdate 	= $startdate; 
			$paysheet->stopdate 	= $stopdate ; 

			$paysheet->save();

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
				$payment->inces 			= $employee->inces;
				$payment->forced_stop 		= $employee->forced_stop;
				$payment->received_loans 	= $employee->received_loans;
				$payment->net_total			= $employee->net_total;

				$payment->save();
			}
			
			$url = '/admin/print/paysheet/'.$paysheet->id;
			
			return View::make('admin.print.sendtoprint')->with('url',$url);
		}
		else
		{
			// a error message must be shown
			return Redirect::to('admin'); 
		}
	}

	public function get_list()
	{
		$title = $this->title.' - Listado de nominas';
		
		$paysheets = Paysheet::order_by('id','desc')->get();
		
		return View::make('admin.paysheets.list')->with('title',$title)->with('paysheets',$paysheets);
	}
}