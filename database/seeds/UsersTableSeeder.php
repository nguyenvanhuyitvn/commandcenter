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

        $user1 = User::create( ['id'=>3, "name"=>"Nguyễn Khắc Hiền",'image'=>'public\uploads\avatar.jpg','parent_id'=>0, "email"=>"nguyenkhachien@gmail.com", "password"=>bcrypt('123456'), 'hospitals_id'=>0, 'positions_id'=>7, 'departments_id'=>1,'account_types_id'=>2, 'status'=>1]);
        $user1->roles()->attach($depts_director);
        $user2 = User::create(['id'=>4, "name"=>"Tạ Thị Vân Anh",'image'=>'public\uploads\avatar.jpg','parent_id'=>2, "email"=>"tavananh@gmail.com", "password"=>bcrypt('123456'), 'hospitals_id'=>2, 'positions_id'=>3, 'departments_id'=>1,'account_types_id'=>1, 'status'=>1]);
        $user2->roles()->attach($hospital_director);
        $user3 = User::create(['id'=>1, "name"=>"Vũ Đức Đam",'image'=>'public\uploads\avatar.jpg', 'parent_id'=>0,"email"=>"vuducdam@gmail.com", "password"=>bcrypt('123456'), 'hospitals_id'=>0, 'positions_id'=>5, 'departments_id'=>1,'account_types_id'=>3, 'status'=>1]);
        $user3->roles()->attach($minister);
    }
}
