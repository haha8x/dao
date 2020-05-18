<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequestUpdateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_updates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dao_old', 50);
            $table->string('dao_update', 50);
            $table->integer('zone_id');
            $table->integer('branch_id');
            $table->string('staff_id', 50);
            $table->string('staff_name', 50);
            $table->string('position_id', 50);
            $table->string('cif', 50);
            $table->string('email', 50);
            $table->string('cmnd', 50);
            $table->date('from_date');
            $table->date('to_date')->nullable();
            $table->string('status', 50);
            $table->string('note', 255);
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_updates');
    }
}
