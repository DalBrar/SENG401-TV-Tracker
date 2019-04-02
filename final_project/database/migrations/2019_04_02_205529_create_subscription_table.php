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
          $table->bigInteger('user_id');
          $table->foreign('user_id')->references('id')->on('users');
          $table->bigInteger('user_id');
          $table->foreign('content_id')->references('id')->on('contents');
          $table->string('active');
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
        Schema::dropIfExists('subscription');
    }
}
