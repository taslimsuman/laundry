<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('plate');
            $table->string('city');
            $table->string('code');
            $table->integer('price')->default(0);
            $table->string('sold')->nullable();
            $table->string('isold')->nullable();
            $table->string('contact')->nullable();
            $table->string('more')->nullable();
            $table->string('hashtag')->nullable();
            $table->string('digits')->nullable();
            $table->string('enclosed')->nullable();
            $table->string('superEnclosed')->nullable();
            $table->string('doubleEnclosed')->nullable();
            $table->string('middleTriple')->nullable();
            $table->string('feature')->nullable();
            $table->string('vip')->nullable();
            $table->string('type')->nullable();
            $table->string('imgname')->nullable();
            $table->string('canvas')->nullable();
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('plates');
    }
}
