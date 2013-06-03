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

		$paysheetpayments = DB::table('payments_paysheet')
									->where('paysheet_id','=',$id)
									->join('employees','employees.id','=','payments_paysheet.employee_id')
									->get();

		return View::make('admin.print.paysheet')->with('title',$title)->with('paysheet',$paysheet)->with('paysheetpayments',$paysheetpayments);
	}
}