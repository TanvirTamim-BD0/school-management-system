<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'superadmin']);
        $role = Role::create(['name' => 'admin']);   
        $role = Role::create(['name' => 'teacher']);
        $role = Role::create(['name' => 'librarian']);
        $role = Role::create(['name' => 'accountent']);
        $role = Role::create(['name' => 'student']);
        $role = Role::create(['name' => 'guardian']);
    }
}
