<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('title', 120);
            $table->string('staff_id', 50);
            $table->string('dao', 50);
            $table->string('name', 120);
            $table->string('position', 50);
            $table->string('position_sub', 50);
            $table->string('zone_id', 10);
            $table->string('branch_id', 50);
            $table->string('email', 120);
            $table->string('team', 50);
            $table->date('date_sale_of', 50);
            $table->string('note', 255);
            $table->string('position_hr', 200);
            $table->string('position_concurrent', 200);
            $table->date('designate_at');
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
        Schema::dropIfExists('staff');
    }
}
