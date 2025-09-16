<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\School;
use Illuminate\Support\Facades\Hash;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        School::updateOrCreate(
            ['code' => 'TEST01'],
            [
                'name' => 'Test School',
                'province' => 'Gauteng',
                'district' => 'Johannesburg',
                'type' => 'Secondary',
                'status' => 'active',
                'admin_password' => Hash::make('pasword1'),
                'address' => '123 Main St',
                'phone' => '0123456789',
                'email' => 'elvisnoko18@gmail.com',
                'description' => 'Seeded test school',
                'contact_email' => 'elvisnoko18@gmail.com',
                'contact_phone' => '0123456789',
                'is_active' => true,
            ]
        );
    }
}