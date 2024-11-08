<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'login_id' => 'sp-202310001', 
            'name' => 'superadmin', 
            'email' => 'admindhaka@gmail.com',
            'mobile' => '01799646660',
            'password' => Hash::make('Dinajpur@2021'),
            'role' => 'superadmin',
            'status' => 1,
        ]);
    
        $role = Role::where('name','superadmin')->first();
        $permissions = Permission::pluck('id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        //For admin...
        User::create([
            'login_id' => 'ad-202310002', 
            'name' => 'admin', 
            'email' => 'admin@gmail.com',
            'mobile' => '01799646661',
            'password' => Hash::make('123'),
            'role' => 'admin',
            'status' => 1,
        ]);
        
        //For accountent...
        User::create([
            'login_id' => 'ac-202310003', 
            'name' => 'accountent', 
            'email' => 'accountent@gmail.com',
            'mobile' => '01799646662',
            'password' => Hash::make('123'),
            'role' => 'accountent',
            'status' => 1,
        ]);
        
        //For librarian...
        User::create([
            'login_id' => 'lb-202310004', 
            'name' => 'librarian', 
            'email' => 'librarian@gmail.com',
            'mobile' => '01799646663',
            'password' => Hash::make('123'),
            'role' => 'librarian',
            'status' => 1,
        ]);
        
        //For teacher...
        User::create([
            'login_id' => 'tc-202310005', 
            'name' => 'teacher', 
            'email' => 'teacher@gmail.com',
            'mobile' => '01799646664',
            'password' => Hash::make('123'),
            'role' => 'teacher',
            'status' => 1,
        ]);
        
        //For student...
        User::create([
            'login_id' => 'st-202310006', 
            'name' => 'student', 
            'email' => 'student@gmail.com',
            'mobile' => '01799646665',
            'password' => Hash::make('123'),
            'role' => 'student',
            'status' => 1,
        ]);
        
        //For guardian...
        User::create([
            'login_id' => 'gd-202310007', 
            'name' => 'guardian', 
            'email' => 'guardian@gmail.com',
            'mobile' => '01799646666',
            'password' => Hash::make('123'),
            'role' => 'guardian',
            'status' => 1,
        ]);
    }
}
