<?php

class Create_Reports {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('reports', function($table) {
			$table->increments('id');
			$table->text('description');
			$table->date('date');
			$table->decimal('time_spent', 5, 2);
			$table->integer('user_id');
			$table->integer('customer_id');
			$table->integer('organization_id');
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
		Schema::drop('reports');
	}

}