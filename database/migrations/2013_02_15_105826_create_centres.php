<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centres', function (Blueprint $table) {
            $table->increments('id')->unsigned();  //http://stackoverflow.com/questions/18427391/laravel-migration-self-referencing-foreign-key-issue
            $table->string('name');
            $table->string('logo_url');
            $table->string('telephone');
            $table->string('address1');
            $table->string('address2');
            $table->string('post_code');
            $table->string('city');
            $table->string('web_page');
            $table->integer('num_pay_advance_days');
            $table->string('stripe_api_key');
            $table->string('stripe_api_secret');
            $table->string('klarna_api_key');
            $table->string('klarna_api_secret');
            $table->string('klarna_api_key_live');
            $table->string('klarna_api_secret_live');
            $table->integer('noCancelDays');
            $table->string('urlSlug');
            $table->decimal('bookingFee', 10, 2);
            $table->string('default_language')->default('se');
            $table->boolean('useAdminFee')->default(false);

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
        Schema::drop('centres');
    }
}
