<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = User::where('role','superadmin')->first();

        DB::table('contacts')->insert([
            'user_id' => $userData->id,
            'name' => 'WB Softwares',
            'phone' => '+9928387232',
        ]);

    }
}
