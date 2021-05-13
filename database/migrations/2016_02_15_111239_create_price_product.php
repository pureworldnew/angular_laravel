<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('price_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();
            $table->decimal('price', 10, 2);
            $table->timestamps();

            $table->foreign('price_id')->references('id')->on('prices');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('price_product');
    }
}
