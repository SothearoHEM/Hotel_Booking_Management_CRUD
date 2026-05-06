@extends('layouts.app')

@section('title', 'Rooms')

@section('content')
<div>
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Rooms</h1>
            <p class="text-gray-600 mt-1">Manage hotel rooms and availability</p>
        </div>
        <a href="{{ route('rooms.create') }}" 
           class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
            <x-heroicon-o-plus class="w-5 h-5" />
            Add Room
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Room Number
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Type
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Price/Night
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Description
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($rooms as $room)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                {{ $room->room_number }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                {{ $room->type }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                ${{ number_format($room->price_per_night, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <x-status-badge :status="$room->status" type="room" />
                            </td>
                            <td class="px-6 py-4 text-gray-700 max-w-xs truncate">
                                {{ $room->description }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('rooms.show', $room) }}"
                                       class="p-2 text-green-600 hover:bg-green-50 rounded transition-colors"
                                       title="View">
                                        <x-heroicon-o-eye class="w-5 h-5" />
                                    </a>
                                    <a href="{{ route('rooms.edit', $room) }}"
                                       class="p-2 text-blue-600 hover:bg-blue-50 rounded transition-colors"
                                       title="Edit">
                                        <x-heroicon-o-pencil class="w-5 h-5" />
                                    </a>
                                    <form action="{{ route('rooms.destroy', $room) }}" method="POST" 
                                          onsubmit="return confirm('Are you sure you want to delete Room {{ $room->room_number }}?')">
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
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                No rooms found. Click "Add Room" to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($rooms->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $rooms->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
