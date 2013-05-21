<?php

class Create_Documents_Table 
{
	/**
	 * Creates the documents table
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documents', function($table)
		{
			$table->increments('id');
			$table->integer('employee_id');
			$table->integer('document_type_id');
			$table->integer('status');
		});

		DB::query('ALTER TABLE documents ADD expiration DATE');
	}

	/**
	 * Drops the documents table
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('documents');
	}
}