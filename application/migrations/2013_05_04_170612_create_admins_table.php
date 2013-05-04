<?php

class Create_Admins_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admins', function($table) 
		{
			$table->increments('id');
			$table->string('username',15);
			$table->string('password',15);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('admins');
	}

}