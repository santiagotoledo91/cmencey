<?php

class Admin_Employees_Controller extends Base_Controller
{
	public $restful = true;
	
	public function __construct() 
	{
		parent::__construct();

		$this->title = 'Sistema de gestion de personal';
	}

	public function get_manage()
	{
		$title = $this->title.' - Gestionar empleados.';

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

		return View::make('admin.employees.manage')->with('title',$title)->with('employees',$employees);
	}

	public function get_add()
	{
		$title = $this->title.' - Añadir empleado.';

		return View::make('admin.employees.add')->with('title',$title);
	}

	public function post_add()
	{
		// get the input fields, with the name that will be displayed
		$input["Cédula"] 			= Input::get('employee_pin');
		$input["Nombres"] 			= Input::get('employee_firstnames');
		$input["Apellidos"] 		= Input::get('employee_lastnames');
		$input["Cargo"]				= Input::get('employee_role');
		$input["Teléfono"]			= Input::get('employee_phone');
		$input["Dirección"] 		= Input::get('employee_address');
		$input["Salario"] 			= Input::get('employee_salary');
		$input["Cuenta Bancaria"] 	= Input::get('employee_bank_account');
		$input["Talla de Zapatos"] 	= Input::get('employee_size_shoes');
		$input["Talla de Camisa"] 	= Input::get('employee_size_shirt');
		$input["Talla de Pantalon"] = Input::get('employee_size_pant');
		$input["Fecha de Ingreso"] 	= Input::get('employee_startdate');
		$input["Activo"] 			= Input::get('employee_active');

		// set the validation rules
		$rules = array(
				'Cédula'				=> array('required','numeric','max:99999999'),
				'Nombres'				=> array('required','alpha','max:100'),
				'Apellidos'				=> array('required','alpha','max:100'),
				'Cargo'					=> array('required','alpha','max:200'),
				'Teléfono'				=> array('required','numeric','max:99999999999'),
				'Dirección'				=> array('required','max:200'),
				'Salario'				=> array('required','numeric','max:9999'),
				'Cuenta Bancaria'		=> array('max:23'),
				'Talla de Zapatos'		=> array('numeric','max:48'),
				'Talla de Camisa'		=> array('alpha_num','max:3'),
				'Talla de Pantalon'		=> array('numeric','max:50'),
				'Fecha de Ingreso'		=> array('date_format:d-m-Y'),
				'Activo'		=> array('required'),
			);

		// set the custom messages
		$messages = array(
			'required' 		=> 'Campo Obligatorio',
			'numeric'		=> 'Solo Números',
			'alpha'			=> 'Solo Letras',
			'alpha_num'		=> 'Solo Números y Letras',
			'max'			=> 'Máximo :size caracteres',
			'date_format'	=> 'El formato debe ser DD-MM-AAAA',
		);

		// validates the data
		$validation = Validator::make($input, $rules,$messages);

 
		// validation failed
		if ($validation->fails()) 
		{
			return Redirect::to('admin/employees/add')->with_errors($validation);
		} 
	
		else // validation passed
		{
			// validates if the user already exist
			// THIS SHOULD BE A CUSTOM VALIDATION RULE, FIX IT! 
			$pin = Employee::where('employees.pin','=',Input::get('employee_pin'))->first();
			
			// the users exist
			if (!empty($pin)) 
			{
				// creates a new message with the object format
				$messages = new \Laravel\Messages;

				// adds the message
				$messages->add('existe','La Cédula '.Input::get('employee_pin').' ya esta registrada en el sistema');

				// redirects with the error
				return Redirect::to('admin/employees/add')->with_errors($messages);
			}
			else // its new user
			{
				// registers the employee
				$employee = new Employee();

				$employee->pin 			= Input::get('employee_pin');
				$employee->fullname 	= strtoupper(Input::get('employee_firstnames').' '.Input::get('employee_lastnames'));
				$employee->role 		= strtoupper(Input::get('employee_role'));
				$employee->phone 		= Input::get('employee_phone');
				$employee->address 		= strtoupper(Input::get('employee_address'));
				$employee->salary 		= round(Input::get('employee_salary'),2);
				$employee->bank_account = Input::get('employee_bank_account');
				$employee->size_shoes	= Input::get('employee_size_shoes');
				$employee->size_shirt	= strtoupper(Input::get('employee_size_shirt'));
				$employee->size_pant	= Input::get('employee_size_pant');
				$employee->startdate	= date('Y-m-d',strtotime(Input::get('employee_startdate')));
				$employee->active 		= Input::get('employee_active');

				$employee->save();

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

				return Redirect::to('admin/employees/manage');
			}
		}
	}

	public function get_edit($id)
	{
		$title = $this->title .' - Editar empleado.';

		$employee = Employee::find($id);

		$documents = DB::table('documents')
						->where('employee_id','=',$id)
						->join('document_types','document_types.id','=','documents.document_type_id')
						->get(array('*','documents.id as id'));

		if (!empty($employee->startdate)) 	{ $employee->startdate 	= date('d-m-Y',strtotime($employee->startdate)); }
		if (!empty($employee->stopdate))	{ $employee->stopdate 	= date('d-m-Y',strtotime($employee->stopdate)); }
		

		foreach ($documents as $document) 
		{
			if (!empty($document->expiration)) { $document->expiration = date('d-m-Y',strtotime($document->expiration)); }

			if ($document->expires == false) 
			{
				switch ($document->status) 
				{
					// the document its up to date
					case 0:
					case 1:
					case 2: 
						$document->show = '<td> Recibido </td>'; 
						$document->row_class="success-min";
					break; 

					// the document has not been consigned yet
					case 3: 
						$document->show = '<td> <input type="checkbox" name="employee_non_expirable_documents[]" value="'.$document->id.'"> <label class="checkbox"> Marcar como recibido </label> </td>'; 
						$document->row_class="error-min";
					break; 
				}
			}
			else
			{
				switch ($document->status) 
				{
					case 0: 
						$document->row_class="success-min";
						$document->show = '<td> <label> Vigente hasta <input type="text" class="input-small" name="employee_expirable_documents['.$document->id.']" value="'.$document->expiration.'"> </td> </label>'; 
					break;

					case 1: 
						$document->row_class="warning-min";
						$document->show = '<td> <label> Vence el <input type="text" class="input-small" name="employee_expirable_documents['.$document->id.']" value="'.$document->expiration.'"> </td> </label>';
					break;

					case 2: 
						$document->row_class="error-min";
						$document->show = '<td> <label> Vencido desde <input type="text" class="input-small" name="employee_expirable_documents['.$document->id.']" value="'.$document->expiration.'"> </td> </label>';
					break;

					case 3: 
						$document->row_class="error-min";
						$document->show = '<td> <label> Pendiente por registrar <input type="text" class="input-small" name="employee_expirable_documents['.$document->id.']" placeholder="DD-MM-AAAA"> </td> </label>';
					break;
				}
			}

		}

		return View::make('admin.employees.edit')->with('title',$title)->with('employee',$employee)->with('documents',$documents);
	}

	public function post_edit($id)
	{
		// updates the employee information
		$employee = Employee::find($id);

		$employee->role 		= strtoupper(Input::get('employee_role'));
		$employee->salary 		= round(Input::get('employee_salary'),2);
		$employee->phone 		= Input::get('employee_phone');
		$employee->address 		= strtoupper(Input::get('employee_address'));
		$employee->bank_account = Input::get('employee_bank_account');
		$employee->size_shoes	= Input::get('employee_size_shoes');
		$employee->size_shirt	= strtoupper(Input::get('employee_size_shirt'));
		$employee->size_pant	= Input::get('employee_size_pant');
		$employee->active 		= Input::get('employee_active');
		
		$startdate 				= Input::get('employee_startdate');
		if (!empty($startdate)) { $employee->startdate = date('Y-m-d',strtotime(Input::get('employee_startdate'))); } else { $employee->startdate = null; }

		$stopdate 				= Input::get('employee_stopdate');
		if (!empty($stopdate))  { $employee->stopdate = date('Y-m-d',strtotime(Input::get('employee_stopdate'))); } else { $employee->stopdate = null; }

		$employee->save();

		// gets todays date
		$today = date("Y-m-d");

		// close to expire means 1 month or less but still not expired
		$close_to_expire = strtotime(date("Y-m-d", strtotime($today)). "+1 month");
		$close_to_expire = date("Y-m-d",$close_to_expire);

		// retrieves the expirable documents array
		$expirable_documents = Input::get('employee_expirable_documents');

		// updates the status of the documents according to the expiration date
		if (isset($expirable_documents))
		{
		foreach ($expirable_documents as $id=>$expiration) 
			{
				// searches the document to update
				$document = Document::find($id);

				// to prevent blank values to be set as status 2
				if (!empty($expiration))
				{
					$expiration = date('Y-m-d',strtotime($expiration));

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

					$document->expiration = $expiration;
				}

			$document->save();
			}
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
