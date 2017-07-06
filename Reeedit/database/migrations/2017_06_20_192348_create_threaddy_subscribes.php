<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreaddySubscribes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribes', function (Blueprint $table) {
            //
            $table->unsignedInteger("userId")->references("id")->on("users");
            $table->unsignedInteger("threadId")->references("id")->on("threads");
            $table->dateTime("date");
            $table->unsignedInteger("type");
            $table->index(["userId", "threadId"]);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('subscribes');
    }
}
