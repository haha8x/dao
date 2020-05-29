<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequestTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 50);
            $table->integer('zone_id')->unsigned()->references('id')->on('catalog_zones');
            $table->integer('branch_id')->unsigned()->references('id')->on('catalog_branches');
            $table->string('acct_no', 50);
            $table->string('staff_name', 50);
            $table->string('email', 50);
            $table->string('customer_name', 50);
            $table->string('cif', 50);
            $table->string('dao_old', 50);
            $table->string('dao_transfer', 50);
            $table->string('reason', 255)->nullable();
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
        Schema::dropIfExists('request_transfers');
    }
}
