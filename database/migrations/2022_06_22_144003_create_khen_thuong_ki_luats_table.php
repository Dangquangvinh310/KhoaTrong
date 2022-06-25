<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKhenThuongKiLuatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khen_thuong_ki_luats', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->date('ngay')->nullable();
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
        Schema::dropIfExists('khen_thuong_ki_luats');
    }
}
