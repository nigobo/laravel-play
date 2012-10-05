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
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 128);
            $table->text('description');
            $table->boolean('active');
            $table->integer('organization_id')->unsigned();
            $table->timestamps();
        });

        // Customer
        DB::table('customers')->insert(array(
            'name' => 'Kund A',
            'description' => 'Kundbeskrivning A',
            'organization_id' => 1,
        ));

        // Customer
        DB::table('customers')->insert(array(
            'name' => 'Kund B',
            'description' => 'Kundbeskrivning B',
            'organization_id' => 1,
        ));

        // Create reports
        Schema::create('reports', function($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('description');
            $table->date('date');
            $table->decimal('time_spent', 5, 2);
            $table->integer('user_id')->unsigned();
            $table->integer('todo_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('organization_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->boolean('invoiced');
            $table->timestamps();
        });

        DB::table('reports')->insert(array(
            'description' => 'Vad gjordes B',
            'organization_id' => 1,
            'todo_id' => 1,
            'project_id' => 1
        ));

        // Create organization
        Schema::create('organizations', function($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 128);
            $table->timestamps();
        });

        // Create projects
        Schema::create('projects', function($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 128);
            $table->text('description');
            $table->integer('estimate_min');
            $table->integer('estimate_max');
            $table->integer('hour_rate');
            $table->integer('customer_id')->unsigned();
            $table->integer('organization_id')->unsigned();
            $table->boolean('active');
            $table->timestamps();
        });

        // Create tasks
        Schema::create('todos', function($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 128);
            $table->text('description');
            $table->integer('project_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('organization_id')->unsigned();
            $table->string('status');
            $table->timestamps();
        });

        // Dummyproject
        DB::table('todos')->insert(array(
            'title' => 'Sätt upp DNS till Hunfi',
            'description' => 'Å lite till',
            'organization_id' => 1,
            'customer_id' => 1
        ));

        // Create users
        Schema::create('users', function($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('username', 128);
            $table->string('nickname', 128);
            $table->string('email', 128);
            $table->string('password', 64);
            $table->integer('organization_id')->unsigned() ;
            $table->timestamps();
        });

        /**
         * Populate database
         */

        // Dummy organization
        DB::table('organizations')->insert(array(
            'name' => 'BinaryBrick'
        ));

        // Dummy organization 2
        DB::table('organizations')->insert(array(
            'name' => 'Wehay'
        ));

        // Dummyproject
        DB::table('projects')->insert(array(
            'name' => 'Projekt A',
            'description' => 'Beskrivning A',
            'organization_id' => 1,
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
        Schema::drop('todos');
        Schema::drop('projects');
        Schema::drop('users');
    }

}