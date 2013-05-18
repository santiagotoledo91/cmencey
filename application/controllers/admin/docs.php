<?php

class Admin_Docs_Controller extends Base_Controller 
{
	public $layout = 'layouts.admin';
	public $restful = true;

	public function get_index()
	{
		$this->layout->title .= ' - Gestionar documentos.';

		$view = View::make('admin.docs.index');

		$view->document_types = DB::table('document_types')->get();
	
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
		$document_type = new DocumentType();
		
		$document_type->description 	= Input::get('document_type_description');
		$document_type->expires_in 		= Input::get('document_type_expires_in');
		
		$document_type->save();

		return Redirect::to('admin');
	}
}