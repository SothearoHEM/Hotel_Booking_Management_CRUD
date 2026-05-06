@extends('layouts.app')

@section('title', 'Edit Booking')

@section('content')
<div>
    <!-- Back Button -->
    <a href="{{ route('bookings.index') }}"
       class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 mb-6">
        <x-heroicon-o-chevron-left class="w-5 h-5" />
        Back to Bookings
    </a>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Booking #{{ $booking->id }}</h1>

        <form action="{{ route('bookings.update', $booking) }}" method="POST" id="bookingForm">
            @csrf
            @method('PUT')

            <!-- Guest -->
            <div class="mb-4">
                <label for="guest_id" class="block text-sm font-medium text-gray-700 mb-1">
                    Guest <span class="text-red-500">*</span>
                </label>
                <select name="guest_id"
                        id="guest_id"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('guest_id') border-red-500 @enderror"
                        required>
                    <option value="">Select Guest</option>
                    @foreach($guests as $guest)
                        <option value="{{ $guest->id }}"
                              {{ old('guest_id', $booking->guest_id) == $guest->id ? 'selected' : '' }}>
                            {{ $guest->name }} ({{ $guest->email }})
                        </option>
                    @endforeach
                </select>
                @error('guest_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Room -->
            <div class="mb-4">
                <label for="room_id" class="block text-sm font-medium text-gray-700 mb-1">
                    Room <span class="text-red-500">*</span>
                </label>
                <select name="room_id"
                        id="room_id"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('room_id') border-red-500 @enderror"
                        required>
                    <option value="">Select Room</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}"
                              data-price="{{ $room->price_per_night }}"
                              {{ old('room_id', $booking->room_id) == $room->id ? 'selected' : '' }}>
                            Room {{ $room->room_number }} - {{ $room->type }} (${{ number_format($room->price_per_night, 2) }}/night)
                        </option>
                    @endforeach
                </select>
                @error('room_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Check In -->
            <div class="mb-4">
                <label for="check_in" class="block text-sm font-medium text-gray-700 mb-1">
                    Check In <span class="text-red-500">*</span>
                </label>
                <input type="date"
                       name="check_in"
                       id="check_in"
                       value="{{ old('check_in', $booking->check_in->format('Y-m-d')) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('check_in') border-red-500 @enderror"
                       required>
                @error('check_in')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Check Out -->
            <div class="mb-4">
                <label for="check_out" class="block text-sm font-medium text-gray-700 mb-1">
                    Check Out <span class="text-red-500">*</span>
                </label>
                <input type="date"
                       name="check_out"
                       id="check_out"
                       value="{{ old('check_out', $booking->check_out->format('Y-m-d')) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors @error('check_out') border-red-500 @enderror"
                       required>
                @error('check_out')
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
                    <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ old('status', $booking->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ old('status', $booking->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Total Cost (Calculated) -->
            <div class="mb-4 p-4 bg-gray-50 rounded-lg" id="costPreview">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-600">Nights: <span id="nightsCount">{{ $booking->number_of_nights }}</span></p>
                        <p class="text-sm text-gray-600">Price per night: $<span id="pricePerNight">{{ $booking->room->price_per_night }}</span></p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600">Total Cost</p>
                        <p class="text-2xl font-bold text-gray-900" id="totalCost">${{ number_format($booking->total_cost, 2) }}</p>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div class="mb-4">
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
                    Notes
                </label>
                <textarea name="notes"
                          id="notes"
                          rows="3"
                          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-colors">{{ old('notes', $booking->notes) }}</textarea>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 mt-6">
                <button type="submit"
                        class="flex-1 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Update Booking
                </button>
                <a href="{{ route('bookings.index') }}"
                   class="flex-1 bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition-colors text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const roomSelect = document.getElementById('room_id');
    const checkInInput = document.getElementById('check_in');
    const checkOutInput = document.getElementById('check_out');
    const nightsCount = document.getElementById('nightsCount');
    const pricePerNight = document.getElementById('pricePerNight');
    const totalCost = document.getElementById('totalCost');

    function calculateCost() {
        const roomId = roomSelect.value;
        const checkIn = checkInInput.value;
        const checkOut = checkOutInput.value;

        if (roomId && checkIn && checkOut && checkOut > checkIn) {
            fetch('{{ route("bookings.calculate-cost") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    room_id: roomId,
                    check_in: checkIn,
                    check_out: checkOut
                })
            })
            .then(response => response.json())
            .then(data => {
                nightsCount.textContent = data.nights;
                pricePerNight.textContent = data.price_per_night;
                totalCost.textContent = '$' + data.total_cost.toFixed(2);
            });
        }
    }

    roomSelect.addEventListener('change', calculateCost);
    checkInInput.addEventListener('change', calculateCost);
    checkOutInput.addEventListener('change', calculateCost);
});
</script>
@endpush
@endsection
