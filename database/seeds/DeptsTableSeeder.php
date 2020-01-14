<?php

use Illuminate\Database\Seeder;

class DeptsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('depts')->delete();
        DB::table('depts')->insert(
            [
                ['id'=>1, "name"=>"Sở y tế Hà Nội", "logo"=>"public\uploads\so-y-te-hn.png", "districts_id"=>"007", "provinces_id"=>"01", "wards_id"=>"00277","address"=>"Giải Phóng"]
            ]
        );
    }
}
