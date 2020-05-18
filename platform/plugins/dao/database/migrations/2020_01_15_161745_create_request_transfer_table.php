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
            $table->integer('zone_id');
            $table->integer('branch_id');
            $table->string('acct_no', 50);
            $table->string('staff_name', 50);
            $table->string('email', 50);
            $table->string('customer_name', 50);
            $table->string('cif', 50);
            $table->string('dao_old', 50);
            $table->string('dao_transfer', 50);
            $table->string('reason', 255);
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
        Schema::dropIfExists('request_transfers');
    }
}
