<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cif', 50);
            $table->string('acctno', 120);
            $table->string('app_id_c', 120);
            $table->string('product_name', 120);
            $table->integer('zone_id')->unsigned()->references('id')->on('catalog_zones');
            $table->integer('branch_id')->unsigned()->references('id')->on('catalog_branches');
            $table->string('staff_id', 50);
            $table->date('open_date', 120);
            $table->string('name', 120);
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
        Schema::dropIfExists('customers');
    }
}
