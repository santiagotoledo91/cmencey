<?php

class Create_Payments_Socialbeneficts_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments_socialbeneficts', function($table)
		{
			$table->increments('id');
			$table->integer('employee_id');
			$table->string('reason');
			$table->string('check');
			$table->string('servicetime');
			$table->float('antiquity_days');
			$table->float('antiquity_total');
			$table->float('utilities_days');
			$table->float('utilities_total');
			$table->float('vacations_days');
			$table->float('vacations_total');
			$table->float('down_salaries_days');
			$table->float('down_salaries_total');
			$table->float('assignments_total');
			$table->float('received_advances');
			$table->float('received_loans');
			$table->float('others');
			$table->float('deductions_total');
			$table->float('total');
		});

		DB::query('ALTER TABLE payments_socialbeneficts ADD startdate DATE');
		DB::query('ALTER TABLE payments_socialbeneficts ADD stopdate DATE');
		DB::query('ALTER TABLE payments_socialbeneficts ADD createdate DATE');
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('payments_socialbeneficts');;
	}

}