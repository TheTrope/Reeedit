<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreaddyShares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shares', function (Blueprint $table) {
            //
            $table->unsignedInteger("userId")->references("id")->on("users");
            $table->unsignedInteger("threadId")->references("id")->on("threads");
            $table->unsignedInteger("receiverId")->references("id")->on("users");
            $table->dateTime("date");
            $table->index(["userId", "threadId", "receiverId"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shares');
    }
}
