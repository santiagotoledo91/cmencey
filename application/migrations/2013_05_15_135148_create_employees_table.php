<?php

class Create_Employees_Table 
{
	/**
	 * Creates the employees table
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employees', function($table)
		{
			$table->increments('id');
			$table->string('pin',8);
			$table->unique('pin');
			$table->string('fullname',200);
			$table->integer('rol_id');
			$table->string('phone',11);
			$table->string('address',200);
			$table->boolean('active');
			$table->date('startdate');
			$table->date('stopdate');
		});
	}

	/**
	 * Drops the employees table
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('employees');
	}
}