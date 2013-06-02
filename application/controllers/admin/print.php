<?php

class Admin_Print_Controller extends Base_Controller 
{
	public $layout = 'layouts.print';
	public $restful = true;

	public function post_receipts($id)
	{
		$view = View::make('admin.print.receipts');

		$view->paysheet = Paysheet::find($id);
		
		$view->paysheetpayments = DB::table('payments_paysheet')
									->where('paysheet_id','=',$id)
									->join('employees','employees.id','=','payments_paysheet.employee_id')
									->get();
 	
 		$this->layout->content = $view;
	}

	public function get_paysheet($id)
	{
		$view = View::make('admin.print.paysheet');

		$view->paysheet = Paysheet::find($id);

		$view->paysheetpayments = DB::table('payments_paysheet')
									->where('paysheet_id','=',$id)
									->join('employees','employees.id','=','payments_paysheet.employee_id')
									->get();

		$this->layout->content = $view;
	}
}