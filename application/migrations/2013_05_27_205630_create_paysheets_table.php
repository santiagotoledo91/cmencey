<?php

class Create_Paysheets_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('paysheets', function($table)
		{
			$table->increments('id');
			$table->float('total');
		});

		DB::query('ALTER TABLE paysheets ADD startdate DATE UNIQUE');
		DB::query('ALTER TABLE paysheets ADD stopdate DATE UNIQUE');
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('paysheets');
	}

}