<?php

use Illuminate\Database\Seeder;

class PaymentMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->truncate();
        DB::table('payment_methods')->insert([
            'name' => "Cash",
            'shortName' => "Cash"
        ]);
        DB::table('payment_methods')->insert([
            'name' => "Bank Transfer",
            'shortName' => "Transfer"
        ]);
        DB::table('payment_methods')->insert([
            'name' => "Klarna",
            'shortName' => "Klarna"
        ]);
        DB::table('payment_methods')->insert([
            'name' => "Stripe",
            'shortName' => "Stripe"
        ]);
        DB::table('payment_methods')->insert([
            'name' => "Invoice",
            'shortName' => "Invoice"
        ]);
    }
}
