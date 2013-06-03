<?php

class Home_Controller extends Base_Controller 
{
	public function action_index()
	{
		// thats how you pass variables to views
		$title = 'this is a title';
		$variable = 'This is a variable';

		return View::make('home.index')->with('title',$title)->with('variable',$variable)->nest('partial','partials.partial');
	}
}