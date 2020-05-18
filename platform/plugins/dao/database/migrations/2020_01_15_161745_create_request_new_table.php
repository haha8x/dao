<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequestNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_news', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('zone_id');
            $table->integer('branch_id');
            $table->string('staff_id', 50);
            $table->string('staff_name', 50);
            $table->string('position_id', 50);
            $table->string('cif', 50);
            $table->string('email', 50);
            $table->string('cmnd', 50);
            $table->string('phone', 50);
            $table->string('decision_file', 255);
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
        Schema::dropIfExists('request_news');
    }
}
