<?php

use Illuminate\Database\Seeder;

class HospitalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('hospitals')->delete();
        DB::table('hospitals')->insert(
            [
                ['id'=>1, "name"=>"All", "logo"=>"avatar.jpg", "districts_id"=>'007', "provinces_id"=>'01', "wards_id"=>'00277',"address"=>"Giải Phóng","depts_id"=>1 ],
                ['id'=>2, "name"=>"BV Bạch mai", "logo"=>"avatar.jpg", "districts_id"=>'007', "provinces_id"=>'01', "wards_id"=>'00277',"address"=>"Giải Phóng","depts_id"=>1 ]
            ]
        );
    }
}
