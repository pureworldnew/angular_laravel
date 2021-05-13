<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBookingProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('booking_product', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('booking_id')->unsigned()->index();
			$table->integer('product_id')->unsigned()->index();
			$table->decimal('price', 10);
			$table->integer('per_type_time_id')->nullable();
			$table->integer('booking_invoice_id')->nullable();
			$table->dateTime('startDateTime');
			$table->dateTime('endDateTime');
			$table->decimal('quantity', 10);
			$table->decimal('klarna_product_status')->default(1.00);
			$table->timestamps();
			$table->softDeletes();
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
