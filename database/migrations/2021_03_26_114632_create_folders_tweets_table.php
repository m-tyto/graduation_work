<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoldersTweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folders_tweets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('folder_id')->unsigned();
            $table->bigInteger('tweet_id')->unsigned();
            $table->foreign('folder_id')->references('id')->on('folders');
            $table->foreign('tweet_id')->references('id')->on('tweets');
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
        Schema::dropIfExists('folders_tweets');
    }
}
