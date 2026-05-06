@extends('layouts.app')

@section('title', 'Dashboard - Hotel Booking Management')

@section('content')
<div>
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-600 mt-1">Welcome to Hotel Management System</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Rooms -->
        <div class="bg-white rounded-lg shadow p-6 flex items-start gap-4">
            <div class="bg-blue-500 p-3 rounded-lg">
                <x-heroicon-o-home class="w-6 h-6 text-white" />
            </div>
            <div class="flex-1">
                <p class="text-sm text-gray-600">Total Rooms</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['total_rooms'] }}</p>
                <p class="text-xs text-gray-500 mt-1">
                    {{ $stats['available_rooms'] }} available, {{ $stats['occupied_rooms'] }} occupied
                </p>
            </div>
        </div>

        <!-- Total Guests -->
        <div class="bg-white rounded-lg shadow p-6 flex items-start gap-4">
            <div class="bg-green-500 p-3 rounded-lg">
                <x-heroicon-o-users class="w-6 h-6 text-white" />
            </div>
            <div class="flex-1">
                <p class="text-sm text-gray-600">Total Guests</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['total_guests'] }}</p>
                <p class="text-xs text-gray-500 mt-1">Registered guests</p>
            </div>
        </div>

        <!-- Bookings -->
        <div class="bg-white rounded-lg shadow p-6 flex items-start gap-4">
            <div class="bg-purple-500 p-3 rounded-lg">
                <x-heroicon-o-calendar class="w-6 h-6 text-white" />
            </div>
            <div class="flex-1">
                <p class="text-sm text-gray-600">Bookings</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['total_bookings'] }}</p>
                <p class="text-xs text-gray-500 mt-1">
                    {{ $stats['confirmed_bookings'] }} confirmed, {{ $stats['pending_bookings'] }} pending
                </p>
            </div>
        </div>

        <!-- Revenue -->
        <div class="bg-white rounded-lg shadow p-6 flex items-start gap-4">
            <div class="bg-orange-500 p-3 rounded-lg">
                <x-heroicon-o-currency-dollar class="w-6 h-6 text-white" />
            </div>
            <div class="flex-1">
                <p class="text-sm text-gray-600">Revenue</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">${{ number_format($stats['total_revenue'], 2) }}</p>
                <p class="text-xs text-gray-500 mt-1">From confirmed bookings</p>
            </div>
        </div>
    </div>

    <!-- Two Column Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Room Status Overview -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Room Status Overview</h2>
            <div class="space-y-3">
                <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                    <span class="text-gray-700 font-medium">Available Rooms</span>
                    <span class="font-bold text-green-700">{{ $stats['available_rooms'] }}</span>
                </div>
                <div class="flex justify-between items-center p-3 bg-red-50 rounded-lg">
                    <span class="text-gray-700 font-medium">Occupied Rooms</span>
                    <span class="font-bold text-red-700">{{ $stats['occupied_rooms'] }}</span>
                </div>
                <div class="flex justify-between items-center p-3 bg-yellow-50 rounded-lg">
                    <span class="text-gray-700 font-medium">Under Maintenance</span>
                    <span class="font-bold text-yellow-700">{{ $stats['maintenance_rooms'] }}</span>
                </div>
            </div>

            <!-- Occupancy Rate -->
            <div class="mt-6">
                @php
                    $occupancyRate = $stats['total_rooms'] > 0 
                        ? round(($stats['occupied_rooms'] / $stats['total_rooms']) * 100, 1) 
                        : 0;
                @endphp
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-gray-700">Occupancy Rate</span>
                    <span class="text-sm font-bold text-gray-900">{{ $occupancyRate }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $occupancyRate }}%"></div>
                </div>
            </div>
        </div>

        <!-- Recent Bookings -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800">Recent Bookings</h2>
                <a href="{{ route('bookings.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                    View All →
                </a>
            </div>
            <div class="space-y-3">
                @forelse($recentBookings as $booking)
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-medium text-gray-800">
                                Room {{ $booking->room->room_number }}
                            </p>
                            <p class="text-sm text-gray-600">{{ $booking->guest->name }}</p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $booking->check_in->format('M d') }} - {{ $booking->check_out->format('M d, Y') }}
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="font-medium text-gray-800">${{ number_format($booking->total_cost, 2) }}</p>
                            <p class="text-xs font-medium mt-1
                                {{ $booking->status === 'confirmed' ? 'text-green-600' : '' }}
                                {{ $booking->status === 'pending' ? 'text-yellow-600' : '' }}
                                {{ $booking->status === 'cancelled' ? 'text-red-600' : '' }}">
                                {{ strtoupper($booking->status) }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">No recent bookings</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions (Optional) -->
    <div class="mt-6 bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('bookings.create') }}" class="flex items-center gap-3 p-4 border border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition-colors">
                <x-heroicon-o-plus class="w-8 h-8 text-blue-600" />
                <div>
                    <p class="font-medium text-gray-800">New Booking</p>
                    <p class="text-sm text-gray-600">Create a reservation</p>
                </div>
            </a>

            <a href="{{ route('rooms.create') }}" class="flex items-center gap-3 p-4 border border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition-colors">
                <x-heroicon-o-plus class="w-8 h-8 text-green-600" />
                <div>
                    <p class="font-medium text-gray-800">Add Room</p>
                    <p class="text-sm text-gray-600">Register new room</p>
                </div>
            </a>

            <a href="{{ route('guests.create') }}" class="flex items-center gap-3 p-4 border border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition-colors">
                <x-heroicon-o-plus class="w-8 h-8 text-purple-600" />
                <div>
                    <p class="font-medium text-gray-800">Add Guest</p>
                    <p class="text-sm text-gray-600">Register new guest</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection