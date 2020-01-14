<?php

use Illuminate\Database\Seeder;
use App\User;
use App\models\Role;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $hospital_director = Role::where('slug', 'hospital')->first();
        $depts_director = Role::where('slug', 'depts')->first();
        $minister = Role::where('slug', 'minister')->first();

        $user1 = User::create( ['id'=>3, "name"=>"SỞ Y TẾ", "email"=>"giamdocso1@gmail.com", "password"=>bcrypt('123456'),"parent_id"=>2, 'hospitals_id'=>1, 'positions_id'=>7]);
        $user1->roles()->attach($depts_director);
        $user2 = User::create(['id'=>4, "name"=>"Giám đốc viện 1", "email"=>"giamdocvien1@gmail.com", "password"=>bcrypt('123456'),"parent_id"=>3, 'hospitals_id'=>2, 'positions_id'=>3]);
        $user2->roles()->attach($hospital_director);
        $user3 = User::create(['id'=>1, "name"=>"admin", "email"=>"admin@gmail.com", "password"=>bcrypt('123456'),"parent_id"=>0, 'hospitals_id'=>1, 'positions_id'=>5]);
        $user3->roles()->attach($minister);

        DB::table('users')->insert(
            [
                // ['id'=>1, "name"=>"admin", "email"=>"admin@gmail.com", "password"=>bcrypt('123456'),"parent_id"=>0, 'hospitals_id'=>"", 'positions_id'=>5],
                ['id'=>2, "name"=>"BỘ Y TẾ", "email"=>"thutruong@gmail.com", "password"=>bcrypt('123456'),"parent_id"=>1, 'hospitals_id'=>1, 'positions_id'=>6],
                // ['id'=>3, "name"=>"Giám đốc sở 1", "email"=>"giamdocso1@gmail.com", "password"=>bcrypt('123456'),"parent_id"=>2, 'hospitals_id'=>"", 'positions_id'=>7],
                // ['id'=>4, "name"=>"Giám đốc viện 1", "email"=>"giamdocvien1@gmail.com", "password"=>bcrypt('123456'),"parent_id"=>3, 'hospitals_id'=>1, 'positions_id'=>3]
            ]
        );
    }
}
