<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequestCloseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_closes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dao', 50);
            $table->integer('zone_id')->unsigned()->references('id')->on('catalog_zones');
            $table->integer('branch_id')->unsigned()->references('id')->on('catalog_branches');
            $table->string('staff_name', 50);
            $table->integer('position_id')->unsigned()->references('id')->on('catalog_positions');
            $table->integer('level');
            $table->integer('dept_parent');
            $table->string('staff_id', 50);
            $table->string('cif', 50);
            $table->date('from_date');
            $table->date('to_date')->nullable();
            $table->string('email', 50);
            $table->string('cmnd', 50);
            $table->string('status', 50);
            $table->string('note', 255)->nullable();
            $table->integer('created_by')->unsigned()->references('id')->on('users')->index();
            $table->integer('updated_by')->unsigned()->references('id')->on('users')->index();
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('request_closes');
    }
}
