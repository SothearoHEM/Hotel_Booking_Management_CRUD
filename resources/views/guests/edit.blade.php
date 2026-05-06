@extends('layouts.app')

@section('title', 'Edit Guest')

@section('content')
<div>
    <!-- Back Button -->
    <a href="{{ route('guests.index') }}"
       class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 mb-6">
        <x-heroicon-o-chevron-left class="w-5 h-5" />
        Back to Guests
    </a>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Guest: {{ $guest->name }}</h1>

        <form action="{{ route('guests.update', $guest) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                    Full Name <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="name"
                       id="name"
                       value="{{ old('name', $guest->name) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('name') border-red-500 @enderror"
                       required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email"
                       name="email"
                       id="email"
                       value="{{ old('email', $guest->email) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('email') border-red-500 @enderror"
                       required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                    Phone Number <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="phone"
                       id="phone"
                       value="{{ old('phone', $guest->phone) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('phone') border-red-500 @enderror"
                       required>
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- ID Number -->
            <div class="mb-4">
                <label for="id_number" class="block text-sm font-medium text-gray-700 mb-1">
                    ID Number <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="id_number"
                       id="id_number"
                       value="{{ old('id_number', $guest->id_number) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('id_number') border-red-500 @enderror"
                       required>
                @error('id_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address -->
            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                    Address <span class="text-red-500">*</span>
                </label>
                <textarea name="address"
                          id="address"
                          rows="4"
                          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('address') border-red-500 @enderror"
                          required>{{ old('address', $guest->address) }}</textarea>
                @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 mt-6">
                <button type="submit"
                        class="flex-1 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Update Guest
                </button>
                <a href="{{ route('guests.index') }}"
                   class="flex-1 bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition-colors text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
