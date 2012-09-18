<?php

class Create_Customers {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
				//
		Schema::create('customers', function($table) {
			$table->increments('id');
			$table->string('name', 128);
			$table->text('description');
			$table->integer('owner_id');
			$table->timestamps();
		});

	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('customers');
	}

}