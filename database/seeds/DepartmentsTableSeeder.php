<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->delete();
        DB::table('departments')->insert(
            [
                ['id'=>1, "name"=>"Khoa ICU, khuôn viên bệnh viện", 'hospitals_id'=>1],
                ['id'=>2, "name"=>"Khoa Điều dưỡng", 'hospitals_id'=>1],
                ['id'=>3, "name"=>"Khoa Sản", 'hospitals_id'=>1],
            ]
        );
    }
}
