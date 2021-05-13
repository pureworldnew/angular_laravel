<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBookingInvoiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('booking_invoice', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('invoice_id');
			$table->decimal('amount', 10);
			$table->boolean('discounted')->default(0);
			$table->decimal('discounted_amount', 10)->default(0.00);
			$table->string('discounted_reason');
			$table->boolean('cancelled')->default(0);
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
		Schema::drop('booking_invoice');
	}

}
