@extends('layouts.app')

@section('title', 'Guest Details')

@section('content')
<div>
    <!-- Back Button -->
    <a href="{{ route('guests.index') }}"
       class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 mb-6">
        <x-heroicon-o-chevron-left class="w-5 h-5" />
        Back to Guests
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Guest Details Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-start mb-4">
                    <h1 class="text-2xl font-bold text-gray-800">{{ $guest->name }}</h1>
                    <div class="flex gap-2">
                        <a href="{{ route('guests.edit', $guest) }}"
                           class="p-2 text-blue-600 hover:bg-blue-50 rounded transition-colors">
                            <x-heroicon-o-pencil class="w-5 h-5" />
                        </a>
                        <form action="{{ route('guests.destroy', $guest) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this guest?')">
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
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="text-gray-900">{{ $guest->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Phone</p>
                        <p class="text-gray-900">{{ $guest->phone }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">ID Number</p>
                        <p class="text-gray-900">{{ $guest->id_number }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Address</p>
                        <p class="text-gray-900">{{ $guest->address }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Guest Bookings -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Bookings</h2>

                @if($guest->bookings->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Room</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Check In</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Check Out</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Cost</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($guest->bookings as $booking)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <a href="{{ route('bookings.show', $booking) }}"
                                               class="text-blue-600 hover:text-blue-800">
                                                Room {{ $booking->room->room_number }}
                                            </a>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-gray-700">
                                            {{ $booking->check_in->format('M d, Y') }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-gray-700">
                                            {{ $booking->check_out->format('M d, Y') }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <x-status-badge :status="$booking->status" type="booking" />
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-right text-gray-900">
                                            ${{ number_format($booking->total_cost, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">No bookings found for this guest.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
