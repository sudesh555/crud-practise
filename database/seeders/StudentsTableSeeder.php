<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Student::create([
                'name' => 'Student ' . $i,
                'address' => 'Address ' . $i,
                'email' => 'student' . $i . '@example.com',
                'phone' => '123456789' . $i,
                'password' => Hash::make(Str::random(6)),
                'image' => null,
                'remember_token' => Hash::make(Str::random(10)),
            ]);
        }
    }
}
