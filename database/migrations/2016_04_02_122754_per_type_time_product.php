<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PerTypeTimeProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('per_type_time_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned()->index();
            $table->integer('per_type_time_id')->unsigned()->index();
            $table->boolean('active');

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('per_type_time_id')->references('id')->on('per_type_times')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
