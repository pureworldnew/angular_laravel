<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBookingProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('booking_product', function(Blueprint $table)
		{
			$table->foreign('booking_id')->references('id')->on('bookings')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('product_id')->references('id')->on('products')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('booking_product', function(Blueprint $table)
		{
			$table->dropForeign('booking_product_booking_id_foreign');
			$table->dropForeign('booking_product_product_id_foreign');
		});
	}

}
