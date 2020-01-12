<?php

use Illuminate\Database\Seeder;
use App\models\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hospital_director = Role::create([
            'name' => 'Giám đốc viện', 
            'slug' => 'hospital',
            'permission' => [
                'urgent_reports.create' => true,
                'urgent_reports.edit' => true,
                'urgent_reports.update' => true
            ]
        ]);
        $depts_director = Role::create([
            'name' => 'Giám đốc sở', 
            'slug' => 'depts',
            'permission' => [
                'urgent_reports.view' => true,
            ]
        ]);
        $minister= Role::create([ 
            'name' => 'Bộ trưởng', 
            'slug' => 'minister',
            'permission' => [
                'urgent_reports.view' => true,
            ]
        ]);
    }
}
