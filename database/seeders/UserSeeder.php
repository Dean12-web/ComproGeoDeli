<?php

namespace Database\Seeders;

use DB;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => Str::uuid()->toString(),
            'username' => 'superadmin',
            'password' => Hash::make('superadmin'),
            'role_user'=> 'superadmin',
            'created_at'=> now(),
            'updated_at'=> now()
        ]);
    }
}
