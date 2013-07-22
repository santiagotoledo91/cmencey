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
		

		foreach ($employees as $employee)
		{
			
			if (!empty($employee->startdate))	{ $employee->startdate 	= date('d-m-Y',strtotime($employee->startdate)); }

			switch ($employee->active) 
			{
				case 0: $employee->active = 'No'; break;
				case 1:	$employee->active = 'Si';break;
			}
		}

		return View::make('admin.print.proofofemployment_list')->with('title',$title)->with('employees',$employees);
	}

	public function get_solvency_pre()
	{
		$title = $this->title.' - Solvencias.';

		$paysheets = Paysheet::get();

		
		foreach ($paysheets as &$paysheet) 
		{
			if (!empty($paysheet->stopdate))	{ $paysheet->stopdate 	= date('d-m-Y',strtotime($paysheet->stopdate)); }
			if (!empty($paysheet->startdate))	{ $paysheet->startdate 	= date('d-m-Y',strtotime($paysheet->startdate)); }
		}

		
		return View::make('admin.print.solvency_pre')->with('title',$title)->with('paysheets',$paysheets);
	}

	public function post_solvency()
	{
		// validates if the dates are picked the right way (stopdate greather that startdate)
		// THIS SHOULD BE A CUSTOM VALIDATION RULE, FIX IT! 
		$startdate = date('Y-m-d',strtotime(Input::get('solvency_startdate')));
		$stopdate  = date('Y-m-d',strtotime(Input::get('solvency_stopdate')));

		if ($stopdate < $startdate )
		{
			// creates a new message with the object format
			$messages = new \Laravel\Messages;

			// adds the message
			$messages->add('period','El período de pago no es valido');

			// redirects with the error
			return Redirect::to('admin/print/solvency/pre')->with_errors($messages);
		}
		else // the period its ok
		{
			$title = $this->title.' - Solvencias.';

			$concept 	= Input::get('solvency_concept');

			$solvency 	= new StdClass;

			$solvency->payments = DB::table('paysheets')
								->select(array(DB::raw('employees.fullname, employees.pin, SUM(payments_paysheet.'.$concept.') as total')))
								->where('paysheets.startdate','>=',$startdate)
								->where('paysheets.stopdate','<=',$stopdate)
								->join('payments_paysheet','payments_paysheet.paysheet_id','=','paysheets.id')
								->join('employees','employees.id','=','payments_paysheet.employee_id')
								->group_by('payments_paysheet.employee_id')
								->get();
			
			$solvency->startdate 	= date('d-m-Y',strtotime($startdate));
			$solvency->stopdate 	= date('d-m-Y',strtotime($stopdate));
			
			switch ($concept) {
				case 'forced_stop':	$solvency->concept = 'Paro Forzoso'; break;
				case 'sso':			$solvency->concept = 'SSO'; break;
				case 'inces':		$solvency->concept = 'INCES'; break;
				case 'faov':		$solvency->concept = 'FAOV'; break;
			}
			
			return View::make('admin.print.solvency')->with('title',$title)->with('solvency',$solvency);
		}
	}

}