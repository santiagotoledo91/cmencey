<?php

class Admin_Docs_Controller extends Base_Controller 
{
	public $restful = true;

	public function __construct() 
	{
		parent::__construct();

		$this->title = 'Sistema de gestion de personal';
	}

	public function get_manage()
	{
		$title = $this->title.' - Gestionar documentos.';

		$document_types = DB::table('document_types')->get();
		
		return View::make('admin.docs.manage')->with('title',$title)->with('document_types',$document_types);
	}

	public function get_expired()
	{
		$subtitle = 'Documentos vencidos y por vencer';	
		$title = $this->title.' - '.$subtitle;

		$documents = DB::table('documents')
						->join('employees','employees.id','=','documents.employee_id')
						->join('document_types','document_types.id','=','documents.document_type_id')
						->where('documents.status','=',1)
						->where('document_types.expires','=',1)
						->where('employees.active','=',1)
						->or_where('documents.status','=',2)
						->where('document_types.expires','=',1)
						->where('employees.active','=',1)
						->get(array('*','employees.id as employee_id','employees.fullname as employee_fullname','employees.pin as employee_pin'));
										
		foreach ($documents as $document) 
		{
			if (!empty($document->expiration)) { $document->expiration = date('d-m-Y',strtotime($document->expiration)); }

			switch ($document->status) 
			{
				case 1: $document->class = 'warning-min'; 	break;
				case 2: $document->class = 'error-min'; 	break;
			}
		}

		return View::make('admin.docs.expired')->with('title',$title)->with('documents',$documents)->with('subtitle',$subtitle);
	}

	public function get_pending()
	{
		$subtitle = 'Documentos por consignar';	
		$title = $this->title.' - '.$subtitle;

		$documents = DB::table('documents')
						->where('status','=',3)
						->join('employees','employees.id','=','documents.employee_id')
						->join('document_types','document_types.id','=','documents.document_type_id')
						->order_by('documents.id','desc')
						->get(array('*','documents.employee_id as employee_id','employees.fullname as employee_fullname','employees.pin as employee_pin'));

		return View::make('admin.docs.pending')->with('title',$title)->with('subtitle',$subtitle)->with('documents',$documents);
	}

	public function get_add() 
	{
		$title = $this->title.' - Añadir documento.';

		return View::make('admin.docs.add')->with('title',$title);
	}

	public function post_add()
	{
		// get the input fields, with the name that will be displayed
		$input["document_type_description"] = Input::get('document_type_description');
		$input["document_type_expires"] 	= Input::get('document_type_expires');

		// set the validation rules
		$rules = array(
				'document_type_description'	=> array('required','max:100'),
				'document_type_expires'		=> array('required'),
				);

		// set the custom messages
		$messages = array(
			'required' 		=> 'Campo Obligatorio',
			'max'			=> 'Máximo :max caracteres',
		);

		// validates the data
		$validation = Validator::make($input, $rules,$messages);
 
		// validation failed
		if ($validation->fails()) 
		{
			return Redirect::to('admin/docs/add')->with_errors($validation);
		} 
	
		else // validation passed
		{
			// validates if the DOCUMENT already exist
			// THIS SHOULD BE A CUSTOM VALIDATION RULE, FIX IT! 
			$description = DocumentType::where('document_types.description','=',$input['document_type_description'])->first();

			
			// the document exist
			if (!empty($description)) 
			{
				// creates a new message with the object format
				$messages = new \Laravel\Messages;

				// adds the message
				$messages->add('exist','El documento "'.$input['document_type_description'].'" ya esta registrado en el sistema');

				// redirects with the error
				return Redirect::to('admin/docs/add')->with_errors($messages);
			}
			else // its a new document
			{
				// creates the new document type
				$document_type 	= new DocumentType();
				
				$document_type->description = $input['document_type_description'];
				$document_type->expires 	= $input["document_type_expires"];
				$document_type->save();

				// retrives the new document_type ID
				$required_document = DB::table('document_types')
										->where('description','=',$input['document_type_description'])
										->first();

				// gets the ids of the employees wich are registered in the system
				$employees = DB::table('employees')->get();

				// creates the new documents
				foreach ($employees as $employee) 
				{
					$document = new Document();

					$document->employee_id 			= $employee->id;
					$document->document_type_id 	= $required_document->id;
					$document->status 				= 3;
					$document->expiration 			= null;

					$document->save();
				}
				
				return Redirect::to('admin');
			}
		}
	}

	public function get_edit($id) 
	{
		$title = $this->title.' - Editar documento.';

		$document_type = DocumentType::find($id);

		return View::make('admin.docs.edit')->with('title',$title)->with('document_type',$document_type);
	}

	public function post_edit($id) 
	{
		// get the input fields
		$input["document_type_description"] = Input::get('document_type_description');
		$input["document_type_expires"] 	= Input::get('document_type_expires');

		// set the validation rules
		$rules = array(
				'document_type_description'	=> array('required','max:100'),
				'document_type_expires'		=> array('required'),
				);

		// set the custom messages
		$messages = array(
			'required' 		=> 'Campo Obligatorio',
			'max'			=> 'Máximo :max caracteres',
		);

		// validates the data
		$validation = Validator::make($input, $rules,$messages);
 
		// validation failed
		if ($validation->fails()) 
		{
			return Redirect::to('admin/docs/edit/'.$id)->with_errors($validation);
		} 
		else // validation passed
		{
			// gets the wanted "expires" status
			$expires = Input::get('document_type_expires');

			// updates the document type begins
			// find the document type
			$document_type = DocumentType::find($id);

			$document_type->description = $input["document_type_description"];

			// gets the registered documents of that type to be updated
			$documents = DB::table('documents')->where('document_type_id','=',$document_type->id)->get('*','documents.id as id');

			// if the expiration date will be tracked now, then decides if change its status to pending or leave it like before depending on the expiration date value
			if ($document_type->expires == 0 AND $expires == 1) 
			{
				foreach ($documents as $doc) 
				{
					$document = Document::find($doc->id);

					// if the expiration date its null, that means that is a received document without any expiration date and will pass to a pending status, in order to ask for a expiration date
					if ($document->expiration == null)
						{
							$document->status = 3;
						}
					
					// if not, that means its a old-being-tracked document, so the status is not changed for consistency (if you want to track it again), and the expiration date still the same
					$document->save();
				}
			}

			// uptades the document expires value (true or false)
			$document_type->expires	= $expires;

			$document_type->save();

			return Redirect::to('admin/docs/manage');
		}
	}
}