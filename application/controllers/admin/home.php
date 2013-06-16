<?php

class Admin_Home_Controller extends Base_Controller
{
	public function __construct() 
	{
		parent::__construct();

		$this->title = 'Sistema de gestion de personal';
	}

	public function action_index () 
	{
		$title = $this->title.' - Inicio';

		$paysheets = Paysheet::order_by('id','desc')->take(8)->get();

		foreach ($paysheets as $paysheet)
		{
			$paysheet->startdate 	= date('d-m-Y',strtotime($paysheet->startdate));
			$paysheet->stopdate 	= date('d-m-Y',strtotime($paysheet->stopdate));
		}

		$close_to_expire  = DB::table('documents')
								->join('employees','employees.id','=','documents.employee_id')
								->join('document_types','document_types.id','=','documents.document_type_id')
								->where('documents.status','=',1)
								->where('document_types.expires','=',1)
								->where('employees.active','=',1)
								->count();

		$expired = DB::table('documents')
								->join('employees','employees.id','=','documents.employee_id')
								->join('document_types','document_types.id','=','documents.document_type_id')
								->where('documents.status','=',2)
								->where('document_types.expires','=',1)
								->where('employees.active','=',1)
								->count();

		$pending = DB::table('documents')
								->where('status','=',3)
								->join('employees','employees.id','=','documents.employee_id')
								->join('document_types','document_types.id','=','documents.document_type_id')
								->order_by('documents.id','desc')
								->count();

		$employees = DB::table('employees')
								->where('active','=',1)
								->count();

		$document_types = DB::table('document_types')->count();

		return View::make('admin.home.index')
					->with('title',$title)	
					->with('paysheets',$paysheets)
					->with('expired',$expired)
					->with('close_to_expire',$close_to_expire)
					->with('pending',$pending)
					->with('employees',$employees)
					->with('document_types',$document_types);
	}
}