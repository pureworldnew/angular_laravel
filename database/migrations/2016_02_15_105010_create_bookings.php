<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('centre_id')->unsigned()->index();
            $table->string('token');
            $table->string('name');
            $table->string('address');
            $table->string('address2');
            $table->string('city');
            $table->string('post_code');
            $table->integer('country');
            $table->string('email');
            $table->string('telephone');
            $table->integer('user_id')->nullable(); //This is untested - set manually in database - of use - ? http://stackoverflow.com/questions/17452923/empty-string-instead-of-null-values-eloquent/19101473#19101473
            $table->integer('status');
            $table->boolean('paid');
            $table->string('payment_method');
            $table->integer('payment_method_id');
            $table->string('klarna_orderId');
            $table->string('klarna_reservationId');
            $table->string('booking_invoice_id');
            $table->string('customer_type');
            $table->dateTime('payment_date');
            $table->timestamps();

            $table->foreign('centre_id')->references('id')->on('centres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bookings');
    }
}
