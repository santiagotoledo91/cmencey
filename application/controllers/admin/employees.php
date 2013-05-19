<?php

class Admin_Employees_Controller extends Base_Controller
{
	public $layout = 'layouts.admin';
	public $restful = true;

	public function get_manage()
	{
		$this->layout->title .= ' - Gestionar empleados.';

		$view = View::make('admin.employees.manage');

		$view->employees = DB::table('employees')->get();

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

		$view->documents = DB::table('document_types')->get();

		$this->layout->content = $view;
	}

	public function post_add()
	{
		// registers the employee

		$employee = new Employee();

		$employee->pin 			= Input::get('employee_pin');
		$employee->fullname 	= Input::get('employee_firstnames').' '.Input::get('employee_lastnames');
		$employee->role 		= Input::get('employee_role');
		$employee->phone 		= Input::get('employee_phone');
		$employee->address 		= Input::get('employee_address');
		$employee->salary 		= Input::get('employee_salary');
		$employee->active 		= 0;

		$employee->save();

		// retrieves the employee id
		$employee = Employee::where('pin','=',Input::get('employee_pin'))->first();

		// retrieves the aviable document types
		$document_types = DB::table('document_types')->get();

		// register the employee documents in the documents table 
		foreach ($document_types as $document_type) 
		{
			$document = new Document();

			$document->employee_id 			= $employee->id;
			$document->document_type_id 	= $document_type->id;
			$document->status 				= 3;
			$document->expires	 			= null;

			$document->save();
		}

		return Redirect::to('admin');
	}
}
