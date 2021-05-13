<?php

use Illuminate\Database\Seeder;

class PricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prices')->truncate();
        DB::table('prices')->insert([
            'name' => "Per hour",
            'shortCode' => 'PerHour'
        ]);
        DB::table('prices')->insert([
            'name' => "Per hour on the weekend",
            'shortCode' => 'PerHourWeekend'
        ]);
        DB::table('prices')->insert([
            'name' => "Per day during the week",
            'shortCode' => 'PerDayWeek'
        ]);
        DB::table('prices')->insert([
            'name' => "Per day during the weekend",
            'shortCode' => 'PerDayWeekend'
        ]);
        DB::table('prices')->insert([
            'name' => "Per half day during the week",
            'shortCode' => 'PerHalfDayWeek'
        ]);
        DB::table('prices')->insert([
            'name' => "Per half day on the weekend",
            'shortCode' => 'PerHalfDayWeekend'
        ]);
        DB::table('prices')->insert([
            'name' => "Per product",
            'shortCode' => 'PerProduct'
        ]);
        DB::table('prices')->insert([
            'name' => "Per booking",
            'shortCode' => 'PerBooking'
        ]);
        DB::table('prices')->insert([
            'name' => "Price per hour (3-4 hours)",
            'shortCode' => 'PerHourOverFour'
        ]);
        DB::table('prices')->insert([
            'name' => "Price / hour (3-4 hours on weekend)",
            'shortCode' => 'PerHourOverFourWeekend'
        ]);
        DB::table('prices')->insert([
            'name' => "Pris / day (3-6 days)",
            'shortCode' => 'PerThreeSixDays'
        ]);
        DB::table('prices')->insert([
            'name' => "Per week",
            'shortCode' => 'PerWeek'
        ]);
    }
}
