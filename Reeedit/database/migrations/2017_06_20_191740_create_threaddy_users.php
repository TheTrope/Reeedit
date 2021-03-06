<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreaddyUsers extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      //
      $table->increments('id');
      $table->string('email')->unique();
      $table->string('username')->unique();
      $table->string('password');
      $table->string('role');
      $table->rememberToken();
      $table->dateTime("createdAt");
      $table->dateTime("connectedAt");

    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
        Schema::drop('users');
  }
}
