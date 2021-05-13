<?php

use Illuminate\Database\Seeder;

class PerTypeTimeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('per_type_times')->truncate();
        DB::table('per_type_times')->insert([
            'id' => 1,
            'type_time_name' => "per hour",
            'type_time_value' => "perHour"
        ]);

        DB::table('per_type_times')->insert([
            'id' => 2,
            'type_time_name' => "per day",
            'type_time_value' => "perDay"
        ]);
    }
}
