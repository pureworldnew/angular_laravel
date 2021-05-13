<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePriceProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('price_product', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('price_id')->unsigned()->index();
			$table->integer('product_id')->unsigned()->index();
			$table->decimal('price', 10);
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
		Schema::drop('price_product');
	}

}
