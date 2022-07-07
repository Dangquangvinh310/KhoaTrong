<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnKhenthuongKyluatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        

         Schema::table('luongs', function (Blueprint $table) {
            $table->string('khen_thuong')->nullable();
        });
        Schema::table('luongs', function (Blueprint $table) {
            $table->string('ky_luat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
