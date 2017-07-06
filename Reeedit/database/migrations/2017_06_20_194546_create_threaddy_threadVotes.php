<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreaddyThreadVotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threadVotes', function (Blueprint $table) {
            //
            $table->unsignedInteger("userId")->references("id")->on("users");
            $table->unsignedInteger("threadId")->references("id")->on("threads");
            $table->unsignedInteger("value");
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
        Schema::drop('threadVotes');
    }
}
