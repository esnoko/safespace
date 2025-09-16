<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'school_code' => 'TEST01',
                'school_email' => 'admin@testschool.com',
            ],
            [
                'school_name' => 'Test School',
                'school_code' => 'TEST01',
                'school_email' => 'admin@testschool.com',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}