<?php

class Create_Projects {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function($table) {
			$table->increments('id');
			$table->string('name', 128);
			$table->text('description');
			$table->integer('estimate_min');
			$table->integer('estimate_max');
			$table->integer('customer_id');
			$table->integer('organization_id');
			$table->timestamps();
		});

		DB::table('projects')->insert(array(
			'name' => 'Testprojektet',
			'description' => 'Beskrivning'
		));
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('projects');
	}

}