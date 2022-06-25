<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNgayNghisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ngay_nghis', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->date('ngay_bat_dau_nghi')->nullable();
            $table->date('ngay_di_lam_lai')->nullable();
            $table->string('ly_do')->nullable();
            $table->string('trang_thai')->nullable();
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
        Schema::dropIfExists('ngay_nghis');
    }
}
