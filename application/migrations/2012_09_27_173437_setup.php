<?php

class Setup {

    /**
     * Make changes to the database.
     *
     * @return void
     */
    public function up()
    {

        /**
         * Create schema
         */

        // Create customers
        Schema::create('customers', function($table) {
            $table->increments('id');
            $table->string('name', 128);
            $table->text('description');
            $table->integer('owner_id');
            $table->integer('organization_id');
            $table->boolean('active');
            $table->timestamps();
        });

        // Create reports
        Schema::create('reports', function($table) {
            $table->increments('id');
            $table->text('description');
            $table->date('date');
            $table->decimal('time_spent', 5, 2);
            $table->integer('user_id');
            $table->integer('customer_id');
            $table->integer('organization_id');
            $table->integer('project_id');
            $table->boolean('invoiced');
            $table->timestamps();
        });

        // Create organization
        Schema::create('organizations', function($table) {
            $table->increments('id');
            $table->string('name', 128);
            $table->timestamps();
        });

        // Create projects
        Schema::create('projects', function($table) {
            $table->increments('id');
            $table->string('name', 128);
            $table->text('description');
            $table->integer('estimate_min');
            $table->integer('hour_rate');
            $table->integer('estimate_max');
            $table->integer('customer_id');
            $table->integer('organization_id');
            $table->boolean('active');
            $table->timestamps();
        });


        // Create users
        Schema::create('users', function($table) {
            $table->increments('id');
            $table->string('username', 128);
            $table->string('nickname', 128);
            $table->string('password', 64);
            $table->integer('organization_id');
            $table->timestamps();
        });


        /**
         * Populate database
         */
        
        
        // Dummyproject
        DB::table('projects')->insert(array(
            'name' => 'Testprojektet',
            'description' => 'Beskrivning',
            'organization_id' => 1,
        ));

        // Dummy organization
        DB::table('organizations')->insert(array(
            'name' => 'BinaryBrick'
        ));

        // Create admin user
        DB::table('users')->insert(array(
            'username' => 'admin',
            'nickname' => 'Admin',
            'organization_id' => 1,
            'password' => Hash::make('password')
        ));

    }

    /**
     * Revert the changes to the database.
     *
     * @return void
     */
    public function down()
    {       
        Schema::drop('customers');
        Schema::drop('reports');
        Schema::drop('organizations');
        Schema::drop('projects');
        Schema::drop('users');
    }

}