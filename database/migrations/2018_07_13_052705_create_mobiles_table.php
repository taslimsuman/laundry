<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMobilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('provider');
            $table->string('code');
            $table->string('number');
            $table->integer('price')->default(0);
            $table->string('contact');
            $table->string('sold')->nullable();
            $table->string('more')->nullable();
            $table->string('hashtag')->nullable();
            $table->string('feature')->nullable();
            $table->string('vip')->nullable();
            $table->string('type')->nullable();
            $table->string('repeat_three')->nullable();
            $table->string('repeat_four')->nullable();
            $table->string('enclosed')->nullable();
            $table->string('superEnclosed')->nullable();
            $table->string('doubleEnclosed')->nullable();
            $table->string('bothside')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobiles');
    }
}
