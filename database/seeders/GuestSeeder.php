<?php

namespace Database\Seeders;

use App\Models\Guest;
use Illuminate\Database\Seeder;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guests = [
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'phone' => '+1234567890',
                'id_number' => 'ID001',
                'address' => '123 Main St, New York, NY 10001',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'phone' => '+1234567891',
                'id_number' => 'ID002',
                'address' => '456 Oak Ave, Los Angeles, CA 90001',
            ],
            [
                'name' => 'Robert Johnson',
                'email' => 'robert.j@example.com',
                'phone' => '+1234567892',
                'id_number' => 'ID003',
                'address' => '789 Pine Rd, Chicago, IL 60601',
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emily.davis@example.com',
                'phone' => '+1234567893',
                'id_number' => 'ID004',
                'address' => '321 Elm St, Houston, TX 77001',
            ],
            [
                'name' => 'Michael Wilson',
                'email' => 'michael.w@example.com',
                'phone' => '+1234567894',
                'id_number' => 'ID005',
                'address' => '654 Maple Dr, Miami, FL 33101',
            ],
        ];

        foreach ($guests as $guest) {
            Guest::create($guest);
        }
    }
}
