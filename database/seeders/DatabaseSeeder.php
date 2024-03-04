<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\StudentsTableSeeder;
use Database\Seeders\StaffTableSeeder;
use Database\Seeders\RoomSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            StudentsTableSeeder::class,
            StaffTableSeeder::class,
            RoomSeeder::class,
        ]);
    }
}
