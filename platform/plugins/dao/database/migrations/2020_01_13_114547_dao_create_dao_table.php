<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DaoCreateDaoRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vung');
            $table->integer('ma_chi_nhanh');
            $table->string('ho_va_ten', 100);
            $table->integer('chuc_danh');
            $table->integer('trang_thai_dao');
            $table->integer('3_so_ma_chi_nhanh');
            $table->string('ma_nhan_vien', 100);
            $table->integer('cif');
            $table->string('email', 100);
            $table->string('cmnd', 100);
            $table->integer('so_dien_thoai');
            $table->string('qd_lam_viec', 100);
            $table->string('trang_thai_xu_ly', 60);
            $table->string('note', 100);
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
        Schema::dropIfExists('dao_registers');
    }
}
