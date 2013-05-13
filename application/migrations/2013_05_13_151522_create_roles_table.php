<?php

class Create_Roles_Table 
{
	/**
	 * Creates the roles table wich contains the aviable positions on the company
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles', function($table)
		{
			$table->increments('id');
			$table->string('name',100);
			$table->unique('name');
			$table->integer('salary')->unsigned();

		});
	}

	/**
	 * Drops the roles table
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('roles');
	}
}