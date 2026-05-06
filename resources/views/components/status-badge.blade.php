@props(['status', 'type' => 'room'])

@php
    $classes = match([$type, $status]) {
        ['room', 'available'] => 'bg-green-100 text-green-800 border-green-200',
        ['room', 'occupied'] => 'bg-red-100 text-red-800 border-red-200',
        ['room', 'maintenance'] => 'bg-yellow-100 text-yellow-800 border-yellow-200',
        ['booking', 'confirmed'] => 'bg-green-100 text-green-800 border-green-200',
        ['booking', 'pending'] => 'bg-yellow-100 text-yellow-800 border-yellow-200',
        ['booking', 'cancelled'] => 'bg-red-100 text-red-800 border-red-200',
        default => 'bg-gray-100 text-gray-800 border-gray-200',
    };
@endphp

<span class="px-3 py-1 rounded-full text-xs font-medium border {{ $classes }}">
    {{ ucfirst($status) }}
</span>