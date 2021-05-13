<?php

use Illuminate\Database\Seeder;

class PerTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('per_types')->truncate();
        DB::table('per_types')->insert([
            'id' => 1,
            'type_name' => "time",
            'type_value' => "time"
        ]);

        DB::table('per_types')->insert([
            'id' => 2,
            'type_name' => "booking",
            'type_value' => "booking"
        ]);

        DB::table('per_types')->insert([
            'id' => 3,
            'type_name' => "product",
            'type_value' => "product"
        ]);
    }
}
