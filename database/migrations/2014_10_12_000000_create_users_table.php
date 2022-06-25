<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('ma_nhan_vien')->nullable();
            $table->string('ho_ten')->nullable();
            $table->string('cmnd')->nullable();
            $table->date('ngay_sinh')->nullable();
            $table->string('gioi_tinh')->nullable();
            $table->string('dia_chi')->nullable();
            $table->string('so_dien_thoai')->nullable();
            $table->string('email')->nullable();
            $table->string('ma_bhxh')->nullable();
            $table->date('ngay_cap')->nullable();
            $table->date('ngay_het_han')->nullable();
            $table->integer('chuc_vu_id')->nullable();
            $table->date('ngay_nhan_chuc')->nullable();
            $table->integer('phong_ban_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
