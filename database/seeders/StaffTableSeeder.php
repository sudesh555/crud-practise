<?php

namespace Database\Seeders;
use App\Models\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobTypes = ['cook', 'house cleaner', 'cook helper', 'receptionist'];
        for ($i = 1; $i <= 10; $i++) {
            $randomJobType = $jobTypes[array_rand($jobTypes)];
            Staff::create([
                'name' => 'Staff ' . $i,
                'address' => 'Address ' . $i,
                'email' => 'staff' . $i . '@example.com',
                'phone' => '985609898' . $i,
                'job_type' => $randomJobType,
                'remember_token' => Hash::make(Str::random(10)),
            ]);
        }
    }
}
