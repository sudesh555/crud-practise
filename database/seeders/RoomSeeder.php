<?php

namespace Database\Seeders;
use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bedSizes = ['1', '2', '3', '4', '4+'];
        for ($i = 1; $i <= 5; $i++) {
            $randomBedSizes = $bedSizes[array_rand($bedSizes)];
            Room::create([
                'room_number' => 'Room ' . $i,
                'bed_size' => $randomBedSizes
            ]);
        }
    }
}
