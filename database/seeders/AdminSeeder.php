<?php

namespace Database\Seeders;

use App\Models\Administrator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends seeder
{
    public function run()
    {
        Administrator::create([
            'administrator_id' => 'admin',
            'password' => Hash::make('admin'),
        ]);
    }
}