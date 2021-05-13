<?php

use Illuminate\Database\Seeder;

class StartTimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('start_times')->truncate();
        DB::table('start_times')->insert([
            'id' => 1,
            'start_time' => "0:00",
            'start_value' => "000"
        ]);

        DB::table('start_times')->insert([
            'id' => 2,
            'start_time' => "1:00",
            'start_value' => "100"
        ]);

        DB::table('start_times')->insert([
            'id' => 3,
            'start_time' => "2:00",
            'start_value' => "200"
        ]);

        DB::table('start_times')->insert([
            'id' => 4,
            'start_time' => "3:00",
            'start_value' => "300"
        ]);

        DB::table('start_times')->insert([
            'id' => 5,
            'start_time' => "4:00",
            'start_value' => "400"
        ]);

        DB::table('start_times')->insert([
            'id' => 6,
            'start_time' => "5:00",
            'start_value' => "500"
        ]);

        DB::table('start_times')->insert([
            'id' => 7,
            'start_time' => "6:00",
            'start_value' => "600"
        ]);

        DB::table('start_times')->insert([
            'id' => 8,
            'start_time' => "7:00",
            'start_value' => "700"
        ]);

        DB::table('start_times')->insert([
            'id' => 9,
            'start_time' => "8:00",
            'start_value' => "800"
        ]);

        DB::table('start_times')->insert([
            'id' => 10,
            'start_time' => "9:00",
            'start_value' => "900"
        ]);

        DB::table('start_times')->insert([
            'id' => 11,
            'start_time' => "10:00",
            'start_value' => "1000"
        ]);

        DB::table('start_times')->insert([
            'id' => 12,
            'start_time' => "11:00",
            'start_value' => "1100"
        ]);

        DB::table('start_times')->insert([
            'id' => 13,
            'start_time' => "12:00",
            'start_value' => "1200"
        ]);

        DB::table('start_times')->insert([
            'id' => 14,
            'start_time' => "13:00",
            'start_value' => "1300"
        ]);

        DB::table('start_times')->insert([
            'id' => 15,
            'start_time' => "14:00",
            'start_value' => "1400"
        ]);

        DB::table('start_times')->insert([
            'id' => 16,
            'start_time' => "15:00",
            'start_value' => "1500"
        ]);

        DB::table('start_times')->insert([
            'id' => 17,
            'start_time' => "16:00",
            'start_value' => "1600"
        ]);

        DB::table('start_times')->insert([
            'id' => 18,
            'start_time' => "17:00",
            'start_value' => "1700"
        ]);

        DB::table('start_times')->insert([
            'id' => 19,
            'start_time' => "18:00",
            'start_value' => "1800"
        ]);

        DB::table('start_times')->insert([
            'id' => 20,
            'start_time' => "19:00",
            'start_value' => "1900"
        ]);

        DB::table('start_times')->insert([
            'id' => 21,
            'start_time' => "20:00",
            'start_value' => "2000"
        ]);

        DB::table('start_times')->insert([
            'id' => 22,
            'start_time' => "21:00",
            'start_value' => "2100"
        ]);

        DB::table('start_times')->insert([
            'id' => 23,
            'start_time' => "22:00",
            'start_value' => "2200"
        ]);

        DB::table('start_times')->insert([
            'id' => 24,
            'start_time' => "23:00",
            'start_value' => "2300"
        ]);
    }
}
