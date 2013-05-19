<?php

class Admin_Employees_Controller extends Base_Controller
{
	public $layout = 'layouts.admin';
	public $restful = true;

	public function get_manage()
	{
		$this->layout->title .= ' - Gestionar empleados.';

		$view = View::make('admin.employees.manage');

		$view->employees = DB::table('employees')->join('roles','roles.id','=','employees.role_id')->get(array('*','employees.id as id'));

		foreach ($view->employees as $employee)
		{
			switch ($employee->active) 
			{
				case 0: $employee->active = 'No'; break;
				case 1:	$employee->active = 'Si';break;
			}
		}

		$this->layout->content = $view;
	}

	public function get_add()
	{
		$this->layout->title .= ' - Añadir empleado.';

		$view = View::make('admin.employees.add');

		$view->roles 		= DB::table('roles')->get();
		$view->documents 	= DB::table('document_types')->get();

		$this->layout->content = $view;
	}

	public function post_add()
	{
		// registers the employee

		$employee = new Employee();

		$employee->pin 			= Input::get('employee_pin');
		$employee->fullname 	= Input::get('employee_firstnames').' '.Input::get('employee_lastnames');
		$employee->role_id 		= Input::get('employee_role');
		$employee->phone 		= Input::get('employee_phone');
		$employee->address 		= Input::get('employee_address');
		$employee->active 		= 0;

		$employee->save();

		// retrieves the employee id
		$employee = Employee::where('pin','=',Input::get('employee_pin'))->first();

		// retrieves the required documents for the employee
		$employee_documents = Input::get('employee_documents');

		// register the required documents in the documents table 
		foreach ($employee_documents as $required_document) 
		{
			$document = new Document();

			$document->employee_id 			= $employee->id;
			$document->document_type_id 	= $required_document;
			$document->status 				= 3;
			$document->expires	 			= null;

			$document->save();
		}

		return Redirect::to('admin');
	}
}
