<?php

class Admin_Docs_Controller extends Base_Controller 
{
	public $layout = 'layouts.admin';
	public $restful = true;

	public function get_manage()
	{
		$this->layout->title .= ' - Gestionar documentos.';

		$view = View::make('admin.docs.manage');

		$view->document_types = DB::table('document_types')->get();
		
		$this->layout->content = $view;
	}

	public function get_expired()
	{
		$subtitle = ' - Documentos vencidos y por vencer';	

		$this->layout->title .= $subtitle;

		$view = View::make('admin.docs.expired');

		$view->documents = DB::table('documents')
									->join('employees','employees.id','=','documents.employee_id')
									->join('document_types','document_types.id','=','documents.document_type_id')
									->where('documents.status','=',1)
									->where('document_types.expires','=',1)
									->or_where('documents.status','=',2)
									->where('document_types.expires','=',1)
									->get(array('*','employees.id as employee_id','employees.fullname as employee_fullname','employees.pin as employee_pin'));
										
		foreach ($view->documents as $document) 
		{
			switch ($document->status) 
			{
				case 1: $document->class = 'warning'; 	break;
				case 2: $document->class = 'error'; 	break;
			}
		}

		$view->subtitle = $subtitle;

		$this->layout->content = $view;
	}

	public function get_pending()
	{
		$subtitle = ' - Documentos por consignar';	

		$this->layout->title .= $subtitle;

		$view = View::make('admin.docs.pending');

		$view->documents = DB::table('documents')
							->where('status','=',3)
							->join('employees','employees.id','=','documents.employee_id')
							->join('document_types','document_types.id','=','documents.document_type_id')
							->order_by('documents.id','desc')
							->get(array('*','documents.employee_id as employee_id','employees.fullname as employee_fullname','employees.pin as employee_pin'));

		$view->subtitle = $subtitle;

		$this->layout->content = $view;
	}

	public function get_add() 
	{
		$this->layout->title .=' - Añadir documento.';

		$view = View::make('admin.docs.add');

		$view->employees = DB::table('employees')->get();

		$this->layout->content = $view;
	}

	public function post_add()
	{
		// creates the new document type
		$document_type 	= new DocumentType();
		
		$document_type->description = Input::get('document_type_description');
		$document_type->expires 	= Input::get('document_type_expires');
		$document_type->save();

		// retrives the new document_type ID
		$required_document = DB::table('document_types')
								->where('description','=',Input::get('document_type_description'))
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

	public function get_edit($id) 
	{
		$this->layout->title .=' - Editar documento.';

		$view = View::make('admin.docs.edit');

		$view->document_type = DocumentType::find($id);

		$this->layout->content = $view;
	}

	public function post_edit($id) 
	{
		// gets the wanted "expires" status
		$expires = Input::get('document_type_expires');

		// updates the document type begins
		// find the document type
		$document_type = DocumentType::find($id);

		$document_type->description = Input::get('document_type_description');

		// gets the registered documents of that type to be updated
		$documents = DB::table('documents')->where('document_type_id','=',$document_type->id)->get('*','documents.id as id');

		// if the expiration date will be tracked now, then decides if change its status to pending or leave it like before depending on the expiration date value
		if ($document_type->expires == 0 AND $expires == 1) 
		{
			foreach ($documents as $doc) 
			{
				$document = Document::find($doc->id);

				// if the expiration date its null, that means that is a recieved document without any expiration date and will pass to a pending status, in order to ask for a expiration date
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