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
			$table->integer('weekly_salary');
			$table->boolean('mo');
			$table->boolean('tu');
			$table->boolean('we');
			$table->boolean('th');
			$table->boolean('fr');
			$table->boolean('sa');
			$table->boolean('su');
			$table->integer('feeding_bonus');
			$table->integer('extra_hours');
			$table->integer('production_bonus');
			$table->integer('extra_raws');
			$table->integer('others');
			$table->integer('accrued_total');
			$table->integer('sso');
			$table->integer('faov');
			$table->integer('forced_stop');
			$table->integer('received_loans');
			$table->integer('net_total');
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