<?php

use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->delete();
        DB::table('areas')->insert(
            [
                ['id'=>1, "name"=>"Khu CNTT A5", "code"=>"CNTTA5", "hospitals_id"=>"2"],
                ['id'=>2, "name"=>"Khu CNTT A6", "code"=>"CNTTA6", "hospitals_id"=>"2"],
                ['id'=>3, "name"=>"Khu CNTT A7", "code"=>"CNTTA7", "hospitals_id"=>"2"]
            ]
        );
    }
}
