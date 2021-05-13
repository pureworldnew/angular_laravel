<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBookingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bookings', function(Blueprint $table)
		{
			$table->foreign('centre_id')->references('id')->on('centres')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('booking_invoice_id', 'bookings_invoice_id_foreign')->references('id')->on('booking_invoice')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bookings', function(Blueprint $table)
		{
			$table->dropForeign('bookings_centre_id_foreign');
			$table->dropForeign('bookings_invoice_id_foreign');
		});
	}

}
