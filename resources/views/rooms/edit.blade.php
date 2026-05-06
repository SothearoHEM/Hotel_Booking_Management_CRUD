@extends('layouts.app')

@section('title', 'Edit Room')

@section('content')
<div>
    <!-- Back Button -->
    <a href="{{ route('rooms.index') }}" 
       class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 mb-6">
        <x-heroicon-o-chevron-left class="w-5 h-5" />
        Back to Rooms
    </a>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Room #{{ $room->room_number }}</h1>

        <form action="{{ route('rooms.update', $room) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Room Number -->
            <div class="mb-4">
                <label for="room_number" class="block text-sm font-medium text-gray-700 mb-1">
                    Room Number <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="room_number" 
                       id="room_number" 
                       value="{{ old('room_number', $room->room_number) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('room_number') border-red-500 @enderror"
                       required>
                @error('room_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Type -->
            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                    Room Type <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="type" 
                       id="type" 
                       value="{{ old('type', $room->type) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('type') border-red-500 @enderror"
                       required>
                @error('type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price Per Night -->
            <div class="mb-4">
                <label for="price_per_night" class="block text-sm font-medium text-gray-700 mb-1">
                    Price per Night <span class="text-red-500">*</span>
                </label>
                <input type="number" 
                       name="price_per_night" 
                       id="price_per_night" 
                       value="{{ old('price_per_night', $room->price_per_night) }}"
                       step="0.01"
                       min="0"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('price_per_night') border-red-500 @enderror"
                       required>
                @error('price_per_night')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                    Status <span class="text-red-500">*</span>
                </label>
                <select name="status" 
                        id="status" 
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('status') border-red-500 @enderror"
                        required>
                    <option value="available" {{ old('status', $room->status) == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="occupied" {{ old('status', $room->status) == 'occupied' ? 'selected' : '' }}>Occupied</option>
                    <option value="maintenance" {{ old('status', $room->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                    Description <span class="text-red-500">*</span>
                </label>
                <textarea name="description" 
                          id="description" 
                          rows="4"
                          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('description') border-red-500 @enderror"
                          required>{{ old('description', $room->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 mt-6">
                <button type="submit" 
                        class="flex-1 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Update Room
                </button>
                <a href="{{ route('rooms.index') }}" 
                   class="flex-1 bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition-colors text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection