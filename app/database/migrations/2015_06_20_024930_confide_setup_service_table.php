<?php
use Illuminate\Database\Migrations\Migration;

class ConfideSetupServiceTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creates the users table
        Schema::create('services', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('serviceName');
            $table->string('status');
			$table->timestamp('updated_at');
            $table->timestamp('created_at');
            $table->unique('serviceName');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {        
        Schema::drop('services');
    }

}
