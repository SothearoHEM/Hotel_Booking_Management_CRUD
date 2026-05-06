<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Hotel Booking Management')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Main Content -->
        <main class="flex-1 overflow-auto">
            <div class="p-6 lg:p-8">
                <!-- Flash Messages -->
                @include('components.flash-message')

                <!-- Page Content -->
                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>
