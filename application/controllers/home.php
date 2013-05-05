<?php

class Home_Controller extends Base_Controller {

	public function action_index()
	{
		// define the $view object as the home.index view loader
		$view = View::make('home.index');

		// thats how you load a partial
		$view->nest('partial','partials.partial');
		
		// thats how you pass variables to views
		$view->variable = 'This is a variable';

		// assigns the content of the view to the "content" property of the layout
		$this->layout->content = $view;
	}

}