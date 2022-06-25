<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLuongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('luongs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('thang_nam')->nullable();
            $table->string('tong_luong')->nullable();
            $table->string('tong_ngay_lam')->nullable();
            $table->string('tam_ung')->nullable();
            $table->string('phu_cap')->nullable();
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
        Schema::dropIfExists('luongs');
    }
}
