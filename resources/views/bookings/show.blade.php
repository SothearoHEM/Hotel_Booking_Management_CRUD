@extends('layouts.app')

@section('title', 'Booking Details')

@section('content')
<div>
    <!-- Back Button -->
    <a href="{{ route('bookings.index') }}"
       class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 mb-6">
        <x-heroicon-o-chevron-left class="w-5 h-5" />
        Back to Bookings
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Booking Details Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-start mb-4">
                    <h1 class="text-2xl font-bold text-gray-800">Booking #{{ $booking->id }}</h1>
                    <div class="flex gap-2">
                        <a href="{{ route('bookings.edit', $booking) }}"
                           class="p-2 text-blue-600 hover:bg-blue-50 rounded transition-colors">
                            <x-heroicon-o-pencil class="w-5 h-5" />
                        </a>
                        <form action="{{ route('bookings.destroy', $booking) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this booking?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded transition-colors">
                                <x-heroicon-o-trash class="w-5 h-5" />
                            </button>
                        </form>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500">Status</p>
                        <x-status-badge :status="$booking->status" type="booking" />
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Guest</p>
                        <p class="text-gray-900">
                            <a href="{{ route('guests.show', $booking->guest) }}" class="text-blue-600 hover:text-blue-800">
                                {{ $booking->guest->name }}
                            </a>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Room</p>
                        <p class="text-gray-900">
                            <a href="{{ route('rooms.show', $booking->room) }}" class="text-blue-600 hover:text-blue-800">
                                Room {{ $booking->room->room_number }} ({{ $booking->room->type }})
                            </a>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Check In</p>
                        <p class="text-gray-900">{{ $booking->check_in->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Check Out</p>
                        <p class="text-gray-900">{{ $booking->check_out->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Nights</p>
                        <p class="text-gray-900">{{ $booking->number_of_nights }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Cost</p>
                        <p class="text-2xl font-bold text-gray-900">${{ number_format($booking->total_cost, 2) }}</p>
                    </div>
                    @if($booking->notes)
                        <div>
                            <p class="text-sm text-gray-500">Notes</p>
                            <p class="text-gray-900">{{ $booking->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Related Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Room Info -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Room Details</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Room Number</p>
                        <p class="text-gray-900">{{ $booking->room->room_number }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Type</p>
                        <p class="text-gray-900">{{ $booking->room->type }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Price per Night</p>
                        <p class="text-gray-900">${{ number_format($booking->room->price_per_night, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Status</p>
                        <x-status-badge :status="$booking->room->status" type="room" />
                    </div>
                </div>
            </div>

            <!-- Guest Info -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Guest Details</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Name</p>
                        <p class="text-gray-900">{{ $booking->guest->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="text-gray-900">{{ $booking->guest->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Phone</p>
                        <p class="text-gray-900">{{ $booking->guest->phone }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">ID Number</p>
                        <p class="text-gray-900">{{ $booking->guest->id_number }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
