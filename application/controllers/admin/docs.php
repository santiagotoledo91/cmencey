<?php

class Admin_Docs_Controller extends Base_Controller 
{
	public $layout = 'layouts.admin';
	public $restful = true;

	public function get_index()
	{
		$this->layout->title .= ' - Documentos pendientes.';
		
		$view = View::make('admin.docs.index');
		
		$this->layout->content = $view;
	}

	public function get_add() 
	{
		$this->layout->title .=' - Añadir documento.';

		$view = View::make('admin.docs.add');

		$this->layout->content = $view;
	}

	public function post_add()
	{
		$document = new DocumentType();
		
		$document->name 		= Input::get('document_name');
		$document->expiration 	= Input::get('expiration');
		
		$document->save();

		return Redirect::to('admin');
	}
}