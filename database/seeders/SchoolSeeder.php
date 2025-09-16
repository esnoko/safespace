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
        $schools = [
            [
                'code' => 'NHS',
                'name' => 'Northfield High School',
                'description' => 'A leading secondary school committed to student safety and wellbeing.',
                'contact_email' => 'admin@northfield.edu',
                'contact_phone' => '+1-555-0101',
                'address' => '123 Education Drive, Northfield, State 12345',
                'admin_password' => Hash::make('nhs2025!'),
                'is_active' => true,
            ],
            [
                'code' => 'RGHS',
                'name' => 'Royal Grammar High School',
                'description' => 'Excellence in education with a focus on student safety and support.',
                'contact_email' => 'admin@royalgrammar.edu',
                'contact_phone' => '+1-555-0202',
                'address' => '456 Academic Lane, Royal City, State 12346',
                'admin_password' => Hash::make('rghs2025!'),
                'is_active' => true,
            ],
            [
                'code' => 'STMARY',
                'name' => 'St. Mary\'s Academy',
                'description' => 'A caring community school prioritizing student wellbeing and safety.',
                'contact_email' => 'admin@stmarys.edu',
                'contact_phone' => '+1-555-0303',
                'address' => '789 Faith Street, Maryville, State 12347',
                'admin_password' => Hash::make('stmary2025!'),
                'is_active' => true,
            ],
            [
                'code' => 'WESTSIDE',
                'name' => 'Westside Community College',
                'description' => 'Higher education institution focused on student safety and success.',
                'contact_email' => 'admin@westside.edu',
                'contact_phone' => '+1-555-0404',
                'address' => '101 College Blvd, Westside, State 12348',
                'admin_password' => Hash::make('westside2025!'),
                'is_active' => true,
            ],
        ];

        foreach ($schools as $school) {
            School::create($school);
        }
    }
}
