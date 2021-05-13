<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('booking_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();
            $table->decimal('price', 10,2);
            $table->integer('per_type_time_id');
            $table->string('booking_invoice_id');
            $table->dateTime('startDateTime');
            $table->dateTime('endDateTime');
            $table->decimal('quantity', 10);
            $table->decimal('klarna_product_status')->default(1);
            $table->timestamps();

            $table->softDeletes();
            
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('booking_product');
    }
}
