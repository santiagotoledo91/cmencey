<?php

class Create_Payments_Paysheet_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments_paysheet', function($table)
		{
			$table->increments('id');
			$table->integer('employee_id');
			$table->integer('paysheet_id');
			$table->float('weekly_salary');
			$table->boolean('mo');
			$table->boolean('tu');
			$table->boolean('we');
			$table->boolean('th');
			$table->boolean('fr');
			$table->boolean('sa');
			$table->boolean('su');
			$table->float('feeding_bonus');
			$table->float('extra_hours');
			$table->float('production_bonus');
			$table->float('extra_raws');
			$table->float('others');
			$table->float('accrued_total');
			$table->float('sso');
			$table->float('faov');
			$table->float('forced_stop');
			$table->float('received_loans');
			$table->float('net_total');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('payments_paysheet');
	}

}