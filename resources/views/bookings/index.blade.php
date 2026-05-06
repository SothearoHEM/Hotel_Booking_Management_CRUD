@extends('layouts.app')

@section('title', 'Bookings')

@section('content')
<div>
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Bookings</h1>
            <p class="text-gray-600 mt-1">Manage hotel bookings and reservations</p>
        </div>
        <a href="{{ route('bookings.create') }}"
           class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
            <x-heroicon-o-plus class="w-5 h-5" />
            Add Booking
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Booking ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Guest
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Room
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Check In
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Check Out
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Cost
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                #{{ $booking->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                <a href="{{ route('guests.show', $booking->guest) }}"
                                   class="text-blue-600 hover:text-blue-800">
                                    {{ $booking->guest->name }}
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                <a href="{{ route('rooms.show', $booking->room) }}"
                                   class="text-blue-600 hover:text-blue-800">
                                    {{ $booking->room->room_number }}
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                {{ $booking->check_in->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                {{ $booking->check_out->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <x-status-badge :status="$booking->status" type="booking" />
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">
                                ${{ number_format($booking->total_cost, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('bookings.show', $booking) }}"
                                       class="p-2 text-green-600 hover:bg-green-50 rounded transition-colors"
                                       title="View">
                                        <x-heroicon-o-eye class="w-5 h-5" />
                                    </a>
                                    <a href="{{ route('bookings.edit', $booking) }}"
                                       class="p-2 text-blue-600 hover:bg-blue-50 rounded transition-colors"
                                       title="Edit">
                                        <x-heroicon-o-pencil class="w-5 h-5" />
                                    </a>
                                    <form action="{{ route('bookings.destroy', $booking) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete Booking #{{ $booking->id }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="p-2 text-red-600 hover:bg-red-50 rounded transition-colors"
                                                title="Delete">
                                            <x-heroicon-o-trash class="w-5 h-5" />
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                                No bookings found. Click "Add Booking" to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($bookings->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $bookings->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
