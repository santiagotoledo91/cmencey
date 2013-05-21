<?php

class Create_Document_Types_Table
{
	/**
	 * Creates the document_types table
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('document_types',function($table)
		{
			$table->increments('id');
			$table->string('description',100);
			$table->unique('description');
			$table->boolean('expires');
		});
	}

	/**
	 * Drops the document_types table
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('document_types');
	}
}
