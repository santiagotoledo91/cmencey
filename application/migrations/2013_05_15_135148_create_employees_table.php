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
			$table->string('role',200);
			$table->string('phone',11);
			$table->string('address',200);
			$table->string('size_shoes',2);
			$table->string('size_shirt',3);
			$table->string('size_pant',2);
			$table->string('bank_account',23);
			$table->float('salary');
			$table->boolean('active');
		});

		DB::query('ALTER TABLE employees ADD startdate DATE');
		DB::query('ALTER TABLE employees ADD stopdate DATE');
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