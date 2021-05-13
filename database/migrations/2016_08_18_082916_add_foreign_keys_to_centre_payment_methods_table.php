<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCentrePaymentMethodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('centre_payment_methods', function(Blueprint $table)
		{
			$table->foreign('centre_id')->references('id')->on('centres')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('payment_methods_id')->references('id')->on('payment_methods')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('centre_payment_methods', function(Blueprint $table)
		{
			$table->dropForeign('centre_payment_methods_centre_id_foreign');
			$table->dropForeign('centre_payment_methods_payment_methods_id_foreign');
		});
	}

}
