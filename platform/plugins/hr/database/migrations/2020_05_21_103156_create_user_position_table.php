<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserPositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('users', 'username')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('username');
            });
        }

        if (Schema::hasColumn('users', 'first_name')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('first_name');
            });
        }

        if (Schema::hasColumn('users', 'last_name')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('last_name');
            });
        }

        Schema::table('users', function ($table) {
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('dao')->nullable();
            $table->string('staff_id', 50)->nullable();
            $table->string('note', 255)->nullable();
        });

        Schema::create('user_positions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->references('id')->on('users')->index();
            $table->integer('position_id')->unsigned()->references('id')->on('catalog_positions')->nullable();
            $table->integer('position_sub_id')->unsigned()->references('id')->on('catalog_positions')->nullable();
            $table->integer('zone_id')->unsigned()->references('id')->on('catalog_zones')->nullable();
            $table->integer('branch_id')->unsigned()->references('id')->on('catalog_branches')->nullable();
            $table->string('team', 50)->nullable();
            $table->date('designate_at')->nullable();
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
        Schema::dropIfExists('user_positions');
    }
}
