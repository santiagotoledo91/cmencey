<?php

class Admin_Print_Controller extends Base_Controller 
{
	public function __construct() 
	{
		parent::__construct();

		$this->title = 'Sistema de gestion de personal';
	}

	public $restful = true;

	public function post_receipts($id)
	{
		$title = $this->title.' - Recibos de pago';

		$paysheet = Paysheet::find($id);
		
		$paysheetpayments = DB::table('payments_paysheet')
								->where('paysheet_id','=',$id)
								->join('employees','employees.id','=','payments_paysheet.employee_id')
								->get();
 		
 		return View::make('admin.print.receipts')->with('title',$title)->with('paysheet',$paysheet)->with('paysheetpayments',$paysheetpayments);
	}

	public function get_paysheet($id)
	{
		$title = $this->title.' - Nomina';

		$paysheet = Paysheet::find($id);
		
		$paysheet->startdate 	= date('d-m-Y',strtotime($paysheet->startdate));
		$paysheet->stopdate 	= date('d-m-Y',strtotime($paysheet->stopdate));
		
		$paysheetpayments = DB::table('payments_paysheet')
									->where('paysheet_id','=',$id)
									->join('employees','employees.id','=','payments_paysheet.employee_id')
									->get();
		foreach ($paysheetpayments as $payment) 
		{
			$payment->startdate = date('d-m-Y',strtotime($payment->startdate));
			$payment->stopdate 	= date('d-m-Y',strtotime($payment->stopdate));
		}
		return View::make('admin.print.paysheet')->with('title',$title)->with('paysheet',$paysheet)->with('paysheetpayments',$paysheetpayments);
	}

	public function get_socialbeneficts($id)
	{
		$title = $this->title.' - Liquidación';

		$payment = DB::table('payments_socialbeneficts')
									->where('payments_socialbeneficts.id','=',$id)
									->join('employees','employees.id','=','payments_socialbeneficts.employee_id')
									->first();

		return View::make('admin.print.socialbeneficts')->with('title',$title)->with('payment',$payment);
	}

	public function get_attendance()
	{
		$title 		= $this->title.' - Control de asistencia';		
		$employees 	= Employee::where('active','=','1')->get();

		return View::make('admin.print.attendance')->with('title',$title)->with('employees',$employees);
	}

	public function get_employees()
	{
		$title 		= $this->title.' - Listado de empleados';	
		$employees 	= Employee::where('active','=','1')->get();

		return View::make('admin.print.employees')->with('title',$title)->with('employees',$employees);
	}

	public function get_proofofemployment($id)
	{
		$title = $this->title.' - Constancia de trabajo';

		$employee = Employee::find($id);

		return View::make('admin.print.proofofemployment')->with('title',$title)->with('employee',$employee);
	}

	public function get_proofofemployment_list()
	{
		$title = $this->title.' - Listado de empleados.';

		$employees = DB::table('employees')->get();
		
		return View::make('admin.print.proofofemployment_list')->with('title',$title)->with('employees',$employees);
	}
}