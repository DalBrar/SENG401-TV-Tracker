<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('content_trakt_id');
            $table->foreign('content_trakt_id')->references('trakt_id')->on('contents')->onDelete('cascade');
            $table->timestamps();

            // Episode Info From Trakt: GET https://api.trakt.tv/shows/id/seasons/season/episodes/episode?extended=full
            // $table->integer('season');
            // $table->integer('number');
            // $table->string('title');
            $table->integer('trakt_id')->unique();
            // $table->text('overview');
            // $table->string('first_aired');
            // $table->double('rating');
            // $table->integer('runtime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episodes');
    }
}
