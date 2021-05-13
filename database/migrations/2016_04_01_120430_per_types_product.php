<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PerTypesProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // No longer have many to many relationship between products and per_types
       /* Schema::create('per_types_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned()->index();
            $table->integer('per_types_id')->unsigned()->index();
            $table->boolean('active');

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('per_types_id')->references('id')->on('per_types')->onDelete('cascade');
        });*/
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
