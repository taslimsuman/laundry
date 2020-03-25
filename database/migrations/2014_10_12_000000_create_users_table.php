<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('profile')->nullable();
            $table->string('email')->unique();
            $table->string('email_token')->nullable();
            $table->string('email_verfy')->nullable();
            $table->string('contact')->nullable();
            $table->string('contact_token')->nullable();
            $table->string('contact_verify')->nullable();
            $table->string('password');
            $table->integer('role_id')->default(0);
            $table->boolean('status')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
