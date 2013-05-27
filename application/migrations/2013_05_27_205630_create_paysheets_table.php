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
		});

		DB::query('ALTER TABLE paysheets ADD startdate DATE');
		DB::query('ALTER TABLE paysheets ADD stopdate DATE');
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