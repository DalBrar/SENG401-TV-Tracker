<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            // Content info from Trake, shared between both movies and TV shows:
            //  TV Shows: GET https://api.trakt.tv/shows/id?extended=full

            // $table->string('title');
            // $table->integer('year');
            $table->integer('trakt_id')->unique();
            // $table->text('overview');
            // $table->integer('runtime');
            // $table->string('certification');
            // $table->string('country');
            // $table->double('rating');
            // $table->string('language');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
}
