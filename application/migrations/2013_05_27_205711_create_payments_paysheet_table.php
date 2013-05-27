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
			$table->integer('salary_base');
			$table->integer('salary_complements');
			$table->integer('bonus_feeding');
			$table->integer('total_accrued');
			$table->integer('sso');
			$table->integer('faov');
			$table->integer('forced_stop');
			$table->integer('advances_received');
			$table->integer('total_net');
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