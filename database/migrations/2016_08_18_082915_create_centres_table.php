<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCentresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('centres', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('logo_url');
			$table->string('telephone');
			$table->string('address1');
			$table->string('address2');
			$table->string('post_code');
			$table->string('city');
			$table->string('web_page');
			$table->integer('num_pay_advance_days');
			$table->string('stripe_secret_key');
			$table->string('stripe_publishable_key');
			$table->string('klarna_api_key');
			$table->string('klarna_api_secret');
			$table->string('klarna_api_key_live');
			$table->string('klarna_api_secret_live');
			$table->boolean('klarna_test_mode')->default(1);
			$table->integer('noCancelDays');
			$table->string('urlSlug')->unique('urlSlug');
			$table->timestamps();
			$table->string('default_language', 4)->default('se');
			$table->decimal('bookingFee', 10);
			$table->boolean('useAdminFee')->default(0);
			$table->decimal('adminFee', 10)->default(0.00);
			$table->boolean('klarna_only')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('centres');
	}

}
