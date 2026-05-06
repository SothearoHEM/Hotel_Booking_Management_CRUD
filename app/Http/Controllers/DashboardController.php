<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\Room;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $stats = [
            'total_rooms' => Room::count(),
            'available_rooms' => Room::available()->count(),
            'occupied_rooms' => Room::occupied()->count(),
            'maintenance_rooms' => Room::maintenance()->count(),
            'total_guests' => Guest::count(),
            'total_bookings' => Booking::count(),
            'confirmed_bookings' => Booking::confirmed()->count(),
            'pending_bookings' => Booking::pending()->count(),
            'cancelled_bookings' => Booking::cancelled()->count(),
            'total_revenue' => Booking::confirmed()->sum('total_cost'),
        ];

        $recentBookings = Booking::with(['room', 'guest'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact('stats', 'recentBookings'));
    }
}
