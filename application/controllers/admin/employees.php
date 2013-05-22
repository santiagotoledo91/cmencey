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
			$document->expiration 			= null;

			$document->save();
		}

		return Redirect::to('admin');
	}

	public function get_edit($id)
	{
		$this->layout->title .= ' - Editar empleado.';

		$view = View::make('admin.employees.edit');

		$view->employee = Employee::find($id);

		$documents = DB::table('documents')
							->where('employee_id','=',$id)
							->join('document_types','document_types.id','=','documents.document_type_id')
							->get();

		foreach ($documents as $document) 
		{
			if ($document->expires == false) 
			{
				switch ($document->status) 
				{
					// the document its up to date
					case 0: 
						$document->show = '<td class="succes"> Recibido </td>'; 
						$document->row_class="success";
					break; 

					// the document has not been consigned yet
					case 3: 
						$document->show = '<td class="error"> <input type="checkbox" name="employee_non_expirable_documents[]" value="'.$document->id.'"> Marcar como recibido </td>'; 
						$document->row_class="error";
					break; 
				}
			}
			else
			{
				switch ($document->status) 
				{
					case 0: 
						$document->row_class="success";
						$document->show = '<td> </label> Vigente hasta <input type="text" name="employee_expirable_documents['.$document->id.']" value="'.$document->expiration.'"> </td>'; 
					break;

					case 1: 
						$document->row_class="warning";
						$document->show = '<td> </label> Vence el <input type="text" name="employee_expirable_documents['.$document->id.']" value="'.$document->expiration.'"> </td>';
					break;

					case 2: 
						$document->row_class="error";
						$document->show = '<td> </label> Vencido desde <input type="text"  name="employee_expirable_documents['.$document->id.']" value="'.$document->expiration.'"> </td>';
					break;

					case 3: 
						$document->row_class="error";
						$document->show = '<td> </label> Pendiente por registrar <input type="text"  name="employee_expirable_documents['.$document->id.']" placeholder="AAAA-MM-DD"> </td>';
					break;
				}
			}

		}

		$view->documents = $documents;

		$this->layout->content = $view;
	}

	public function post_edit($id)
	{
		// updates the employee information
		$employee = Employee::find($id);

		$employee->role 	= Input::get('employee_role');
		$employee->salary 	= Input::get('employee_salary');
		$employee->phone 	= Input::get('employee_phone');
		$employee->address 	= Input::get('employee_address');

		$employee->save();

		// gets todays date
		$today = date("Y-m-d");

		// close to expire means 1 month or less but still not expired
		$close_to_expire = strtotime(date("Y-m-d", strtotime($today)). "+1 month");
		$close_to_expire = date("Y-m-d",$close_to_expire);

		// retrieves the expirable documents array
		$expirable_documents = Input::get('employee_expirable_documents');

		// updates the status of the documents according to the expiration date
		foreach ($expirable_documents as $id=>$expiration) 
		{
			// searches the document to update
			$document = Document::find($id);

			$document->expiration = $expiration;

			// up to date
			if ($expiration > $today)  
			{
				$document->status = 0;
			}

			// about to expire
			if ($expiration <= $close_to_expire)
			{
				$document->status = 1; 
			}

			// expired
			if ($expiration <= $today)
			{
				$document->status = 2;
			}

			$document->save();
		}

		// retrieves the no expirable documents array
		$non_expirable_documents = Input::get('employee_non_expirable_documents');

		if (isset($non_expirable_documents))
		{
			foreach ($non_expirable_documents as $id) 
			{
				$document = Document::find($id);

				// received
				$document->status = 0;

				$document->save();
			}
		}

		return Redirect::to('admin/employees/manage');
	}
}
