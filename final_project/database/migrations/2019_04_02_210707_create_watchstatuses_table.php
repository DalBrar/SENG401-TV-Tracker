<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWatchstatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watch_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('subscription_id')->unsigned();
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade');
            $table->integer('episode_trakt_id');
            $table->foreign('episode_trakt_id')->references('trakt_id')->on('episodes')->onDelete('cascade');
            $table->boolean('watched');
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
        Schema::dropIfExists('watchstatuses');
    }
}
