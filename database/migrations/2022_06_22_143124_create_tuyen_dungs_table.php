<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTuyenDungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tuyen_dungs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('ho_ten')->nullable();
            $table->string('cv')->nullable();
            $table->date('ngay_tuyen')->nullable();
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
        Schema::dropIfExists('tuyen_dungs');
    }
}
