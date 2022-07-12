<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXacNhansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xac_nhans', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
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
            $table->string('trang_thai')->nullable();
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
        Schema::dropIfExists('xac_nhans');
    }
}
