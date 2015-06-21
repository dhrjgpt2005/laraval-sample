<?php
use Illuminate\Database\Migrations\Migration;

class ConfideSetupServicepettypemappingTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creates the users table
        Schema::create('service_pettype_mappings', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('ID');
            $table->integer('SID');
            $table->integer('PTID');
			$table->timestamp('updated_at');
            $table->timestamp('created_at');
            $table->unique('SID');
            $table->unique('PTID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {        
        Schema::drop('service_pettype_mappings');
    }

}
