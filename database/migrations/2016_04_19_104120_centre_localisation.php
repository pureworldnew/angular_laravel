<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CentreLocalisation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centre_localisation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('centre_id')->unsigned()->index();
            $table->string('language');
            $table->string('field_name');
            $table->text('field_value');

            $table->foreign('centre_id')->references('id')->on('centres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('centre_localisation');
    }
}
