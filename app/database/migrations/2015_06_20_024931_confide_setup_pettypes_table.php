<?php
use Illuminate\Database\Migrations\Migration;

class ConfideSetupPettypesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creates the users table
        Schema::create('pettypes', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('pettype');
            $table->string('status');
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
            $table->unique('pettype');		
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {        
        Schema::drop('pettypes');
    }

}
