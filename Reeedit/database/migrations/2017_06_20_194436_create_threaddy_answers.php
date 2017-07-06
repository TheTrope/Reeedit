<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreaddyAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            //
            $table->increments("id");
            $table->unsignedInteger("userId")->references("id")->on("users");
            $table->unsignedInteger("threadId")->references("id")->on("threads");
            $table->text("content");
            $table->unsignedInteger("fromAnswerId")->references("id")->on("answers");
            $table->dateTime("createdAt");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('answers');
    }
}
