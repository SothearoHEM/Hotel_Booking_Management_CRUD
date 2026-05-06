<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Room;
use App\Models\Guest;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $room1 = Room::where('room_number', '101')->first();
        $room2 = Room::where('room_number', '102')->first();
        $room3 = Room::where('room_number', '201')->first();

        $guest1 = Guest::where('email', 'john.doe@example.com')->first();
        $guest2 = Guest::where('email', 'jane.smith@example.com')->first();
        $guest3 = Guest::where('email', 'robert.j@example.com')->first();

        $bookings = [
            [
                'room_id' => $room1->id,
                'guest_id' => $guest1->id,
                'check_in' => Carbon::now()->subDays(5),
                'check_out' => Carbon::now()->addDays(2),
                'total_cost' => $room1->price_per_night * 7,
                'status' => 'confirmed',
                'notes' => 'Guest requested late checkout.',
            ],
            [
                'room_id' => $room2->id,
                'guest_id' => $guest2->id,
                'check_in' => Carbon::now()->subDays(10),
                'check_out' => Carbon::now()->subDays(3),
                'total_cost' => $room2->price_per_night * 7,
                'status' => 'confirmed',
                'notes' => null,
            ],
            [
                'room_id' => $room3->id,
                'guest_id' => $guest3->id,
                'check_in' => Carbon::now()->addDays(5),
                'check_out' => Carbon::now()->addDays(10),
                'total_cost' => $room3->price_per_night * 5,
                'status' => 'pending',
                'notes' => 'Guest will arrive after 6 PM.',
            ],
            [
                'room_id' => $room1->id,
                'guest_id' => $guest2->id,
                'check_in' => Carbon::now()->addDays(15),
                'check_out' => Carbon::now()->addDays(20),
                'total_cost' => $room1->price_per_night * 5,
                'status' => 'pending',
                'notes' => null,
            ],
            [
                'room_id' => $room3->id,
                'guest_id' => $guest1->id,
                'check_in' => Carbon::now()->subDays(30),
                'check_out' => Carbon::now()->subDays(25),
                'total_cost' => $room3->price_per_night * 5,
                'status' => 'cancelled',
                'notes' => 'Guest cancelled due to emergency.',
            ],
        ];

        foreach ($bookings as $booking) {
            Booking::create($booking);
        }
    }
}
