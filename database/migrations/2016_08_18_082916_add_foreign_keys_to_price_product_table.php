<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPriceProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('price_product', function(Blueprint $table)
		{
			$table->foreign('price_id')->references('id')->on('prices')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('product_id')->references('id')->on('products')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('price_product', function(Blueprint $table)
		{
			$table->dropForeign('price_product_price_id_foreign');
			$table->dropForeign('price_product_product_id_foreign');
		});
	}

}
