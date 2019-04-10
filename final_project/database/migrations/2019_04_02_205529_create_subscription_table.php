<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('user_id')->unsigned();
          $table->foreign('user_id')->references('id')->on('users');
          $table->integer('content_trakt_id');
          $table->foreign('content_trakt_id')->references('trakt_id')->on('contents');
          $table->boolean('active');
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
        Schema::dropIfExists('subscriptions');
    }
}
