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

		$view->expired_documents = DB::table('documents')
									->where('status','=',1)
									->or_where('status','=',2)
									->join('employees','employees.id','=','documents.employee_id')
									->join('document_types','document_types.id','=','documents.document_type_id')
									->get(array('*','document_types.description as description','documents.id as id'));
										
		foreach ($view->expired_documents as $expired_document) 
		{
			switch ($expired_document->status) 
			{
				case 1: $expired_document->class = 'warning'; 	break;
				case 2: $expired_document->class = 'error'; 	break;
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

		$view->employees = DB::table('documents')
									->where('status','=',3)
									->join('employees','employees.id','=','documents.employee_id')
									->join('document_types','document_types.id','=','documents.document_type_id')
									->order_by('employees.id','desc')
									->get(array('*','document_types.description as pending_document','documents.employee_id as id'));
		
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
		
		$document_type->description 	= Input::get('document_type_description');
		
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
			$document->expires	 			= null;

			$document->save();
		}
		
		return Redirect::to('admin');
	}
}