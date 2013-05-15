<?php

class Admin_Employees_Controller extends Base_Controller
{
	public $layout = 'layouts.admin';
	public $restful = true;

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

		$employee->pin 			= Input::get('pin');
		$employee->fullname 	= Input::get('firstnames').' '.Input::get('lastnames');
		$employee->rol_id 		= Input::get('rol');
		$employee->phone 		= Input::get('phone');
		$employee->address 		= Input::get('address');
		$employee->active 		= 0;

		$employee->save();

		// retrieves the employee id
		$employee = Employee::where('pin','=',Input::get('pin'))->first();

		// retrieves the required documents for the employee
		$required_documents = Input::get('required_documents');

		// register the required documents in the documents table 
		foreach ($required_documents as $required_document) 
		{
			$document = new Document();

			$document->employee_id 			= $employee->id;
			$document->document_type_id 	= $required_document;
			$document->up_to_date 			= false;
			$document->expiration 			= null;

			$document->save();
		}

		return Redirect::to('admin');
	}
}
