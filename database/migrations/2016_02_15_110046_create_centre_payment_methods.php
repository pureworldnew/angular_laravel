<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentrePaymentMethods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centre_payment_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_methods_id')->unsigned()->index();
            $table->integer('centre_id')->unsigned()->index();
            $table->boolean('active');
            $table->string('api_key');

            $table->foreign('centre_id')->references('id')->on('centres')->onDelete('cascade');
            $table->foreign('payment_methods_id')->references('id')->on('payment_methods');
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
        Schema::drop('centre_payment_methods');
    }
}
