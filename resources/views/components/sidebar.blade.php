<aside class="w-64 bg-gray-900 text-white hidden lg:block">
    <!-- Header -->
    <div class="p-6 border-b border-gray-700">
        <h1 class="text-2xl font-bold">Hotel Manager</h1>
        <p class="text-sm text-gray-400 mt-1">Booking System</p>
    </div>

    <!-- Navigation -->
    <nav class="p-4">
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-4 py-3 mb-2 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
            <x-heroicon-o-home class="w-5 h-5" />
            <span>Dashboard</span>
        </a>

        <a href="{{ route('rooms.index') }}"
           class="flex items-center gap-3 px-4 py-3 mb-2 rounded-lg transition-colors {{ request()->routeIs('rooms.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
            <x-heroicon-o-home class="w-5 h-5" />
            <span>Rooms</span>
        </a>

        <a href="{{ route('guests.index') }}"
           class="flex items-center gap-3 px-4 py-3 mb-2 rounded-lg transition-colors {{ request()->routeIs('guests.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
            <x-heroicon-o-users class="w-5 h-5" />
            <span>Guests</span>
        </a>

        <a href="{{ route('bookings.index') }}"
           class="flex items-center gap-3 px-4 py-3 mb-2 rounded-lg transition-colors {{ request()->routeIs('bookings.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
            <x-heroicon-o-calendar class="w-5 h-5" />
            <span>Bookings</span>
        </a>
    </nav>
</aside>

<!-- Mobile Sidebar Toggle (Optional) -->
<button id="mobile-menu-btn" class="lg:hidden fixed top-4 left-4 z-50 p-2 bg-blue-600 text-white rounded-lg">
    <x-heroicon-o-bars-3 class="w-6 h-6" />
</button>
