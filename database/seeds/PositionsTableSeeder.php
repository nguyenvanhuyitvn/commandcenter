<?php

use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->delete();
        DB::table('positions')->insert(
            [
                ['id'=>1, "name"=>"Bác sĩ"],
                ['id'=>2, "name"=>"Điều dưỡng"],
                ['id'=>3, "name"=>"Giám đốc viện"],
                ['id'=>4, "name"=>"Trưởng khoa"],
                ['id'=>5, "name"=>"Bộ trưởng"],
                ['id'=>6, "name"=>"Thứ trưởng"],
                ['id'=>7, "name"=>"Giám đốc sở"],
            ]
        );
    }
}
