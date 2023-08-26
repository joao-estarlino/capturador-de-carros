<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds and insert static user.
     * 
     * @return void
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'João',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ]);
    }
}
