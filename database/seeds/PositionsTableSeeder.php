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
                ['id'=>1, "name"=>"Bác sĩ", "code"=>"BACSI"],
                ['id'=>2, "name"=>"Điều dưỡng", "code"=>"DIEUDUONG"],
                ['id'=>3, "name"=>"Giám đốc viện", "code"=>"GIAMDOCVIEN"],
                ['id'=>4, "name"=>"Trưởng khoa", "code"=>"TRUONGKHOA"],
                ['id'=>5, "name"=>"Bộ trưởng", "code"=>"BOTRUONG"],
                ['id'=>6, "name"=>"Thứ trưởng", "code"=>"THUTRUONG"],
                ['id'=>7, "name"=>"Giám đốc sở", "code"=>"GIAMDOCSO"],
                ['id'=>8, "name"=>"Nhân viên", "code"=>"NHANVIEN"],
            ]
        );
    }
}
