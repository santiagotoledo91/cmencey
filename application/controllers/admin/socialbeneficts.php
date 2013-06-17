<?php

class Admin_Socialbeneficts_Controller extends Base_Controller
{
	public $restful = true;

	public function __construct() 
	{
		parent::__construct();

		$this->title = 'Sistema de gestion de personal';
	}

	public function get_employeeslist() 
	{
		$title = $this->title .' - Liquidación.';

		$employees = Employee::where('active','=','1')->get();

		return View::make('admin.socialbeneficts.employeeslist')->with('title',$title)->with('employees',$employees);
	}

	public function get_pre($id) 
	{
		$title = $this->title .' - Liquidación ';
		
		$employee = Employee::find($id);

		if(!empty($employee->startdate)) { $employee->startdate = date('d-m-Y',strtotime($employee->startdate)); }

		return View::make('admin.socialbeneficts.pre')->with('title',$title)->with('employee',$employee);
	}

	public function post_view()
	{
		$title = $this->title .' - Liquidación ';

		$employee 						= Employee::find(Input::get('id'));

		$payment 						= new stdClass;

		$payment->reason 				= Input::get('reason'); 
		$payment->check 				= Input::get('check');
		$payment->down_salaries_days	= Input::get('down_salaries_days');
		$payment->received_advances 	= Input::get('received_advances');
		$payment->received_loans		= Input::get('received_loans');
		$payment->others				= Input::get('others'); 
		
		$payment->startdate 			= Input::get('startdate'); 
		$payment->stopdate 				= Input::get('stopdate'); 
		
		// formats the start and stop dates to a object in order to calculate the service time
		$start 	= new DateTime(date('Y-m-d',strtotime($payment->startdate)));
		$stop 	= new DateTime(date('Y-m-d',strtotime($payment->stopdate)));

		$payment->servicetime 			= $start->diff($stop);

		$payment->antiquity_days 		= ( $payment->servicetime->m * 6 ) + ( ($payment->servicetime->d / 30) * 6 );
		$payment->antiquity_total 		= round($payment->antiquity_days * $employee->salary, 2);

		$payment->vacations_days		= round($payment->servicetime->days * 0.21917808219178,2);
		$payment->vacations_total		= round($payment->vacations_days * $employee->salary,2);
		$payment->down_salaries_total 	= round($payment->down_salaries_days * $employee->salary,2);

		// modifies the date in order to calculate the utilities total
		if ($start->format('d')	!= '1') { $start->modify('first day of next month');} 
		if ($stop->format('d')	!= '1') { $stop->modify('first day of this month');	}

		$payment->utilities_days	= $start->diff($stop)->m * 6.25;
		$payment->utilities_total 	= round(($payment->utilities_days) * $employee->salary,2); 

		$payment->assignments_total = round($payment->antiquity_total + $payment->utilities_total + $payment->down_salaries_total + $payment->vacations_total,2);
		$payment->deductions_total 	= round($payment->received_advances - $payment->received_loans - $payment->others);
		
		$payment->total 			= $payment->assignments_total - $payment->deductions_total;

		Session::put('payment',$payment);
		Session::put('employee',$employee);

		return View::make('admin.socialbeneficts.view')->with('title',$title)->with('employee',$employee)->with('payment',$payment);	
	}
}