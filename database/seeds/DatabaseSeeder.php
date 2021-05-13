<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks = 0");
        Model::unguard();
        $this->call(PaymentMethodsTableSeeder::class);
        $this->call(PerTypeTableSeeder::class);
        $this->call(PerTypeTimeTableSeeder::class);
        $this->call(PricesTableSeeder::class);
        $this->call(StartTimesTableSeeder::class);
        $this->call(UserTypeTableSeeder::class);
        Model::reguard();
    }
}
