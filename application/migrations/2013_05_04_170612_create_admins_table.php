<?php

class Create_Admins_Table 
{
	/**
	 * Creates the admins table
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admins', function($table) 
		{
			$table->increments('id');
			$table->string('username',15);
			$table->unique('username');
			$table->string('password',60);
		});

		// @TODO charset = 'utf8_general_ci'

		DB::table('admins')->insert(array('username' => 'admin','password' => Hash::make('admin')));
	}

	/**
	 * Drops the admins table
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('admins');
	}
}