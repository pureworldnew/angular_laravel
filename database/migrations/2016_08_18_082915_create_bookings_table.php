<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBookingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bookings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('centre_id')->unsigned()->index();
			$table->string('token');
			$table->string('name');
			$table->string('address');
			$table->string('address2');
			$table->string('city');
			$table->string('post_code');
			$table->string('email');
			$table->string('billing_email');
			$table->string('billing_name');
			$table->string('billing_address');
			$table->string('billing_address2');
			$table->string('billing_city');
			$table->string('billing_post_code');
			$table->string('billing_country');
			$table->string('billing_telephone');
			$table->string('telephone');
			$table->integer('user_id')->nullable();
			$table->integer('status');
			$table->boolean('paid');
			$table->string('payment_method');
			$table->integer('payment_method_id');
			$table->string('klarna_orderId');
			$table->string('klarna_reservationId');
			$table->boolean('can_be_cancelled')->default(1);
			$table->integer('booking_invoice_id')->nullable()->unique('booking_invoice_id_2');
			$table->dateTime('payment_date');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('country');
			$table->integer('customer_type');
			$table->string('stripe_customer_number');
			$table->string('stripe_charge_id');
			$table->text('freeText', 65535);
			$table->decimal('bookingFee', 10);
			$table->dateTime('cancelled_at')->nullable();
			$table->string('default_language', 4)->default('se');
			$table->boolean('terms_accepted')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bookings');
	}

}
