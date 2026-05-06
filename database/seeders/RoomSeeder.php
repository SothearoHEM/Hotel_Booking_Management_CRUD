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
        $rooms = [
            [
                'room_number' => '101',
                'type' => 'Single',
                'price_per_night' => 100.00,
                'status' => 'available',
                'description' => 'A cozy single room with a comfortable bed and a private bathroom.',
            ],
            [
                'room_number' => '102',
                'type' => 'Double',
                'price_per_night' => 150.00,
                'status' => 'occupied',
                'description' => 'A spacious double room with two beds, perfect for couples or friends.',
            ],
            [
                'room_number' => '201',
                'type' => 'Suite',
                'price_per_night' => 300.00,
                'status' => 'available',
                'description' => 'A luxurious suite with a separate living area, king-size bed, and a stunning view.',
            ],
            [
                'room_number' => '202',
                'type' => 'Double',
                'price_per_night' => 160.00,
                'status' => 'maintenance',
                'description' => 'A well-appointed double room currently under maintenance for renovation.',
            ],
            [
                'room_number' => '301',
                'type' => 'Suite',
                'price_per_night' => 350.00,
                'status' => 'available',
                'description' => 'Premium suite with balcony, Jacuzzi, and panoramic city views.',
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
