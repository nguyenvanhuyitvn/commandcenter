<?php

use Illuminate\Database\Seeder;

class ReportTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('report_types')->delete();
        DB::table('report_types')->insert(
            [
                ['id'=>1, "name"=>"Báo cáo thông thường"],
                ['id'=>2, "name"=>"Báo cáo khẩn cấp"]
            ]
        );
    }
}
