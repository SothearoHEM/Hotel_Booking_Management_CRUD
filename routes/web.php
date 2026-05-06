<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Rooms Resource Routes
Route::resource('rooms', RoomController::class);

// Guests Resource Routes
Route::resource('guests', GuestController::class);

// Bookings Resource Routes
Route::resource('bookings', BookingController::class);

// AJAX Route for calculating booking cost
Route::post('/bookings/calculate-cost', [BookingController::class, 'calculateCost'])
    ->name('bookings.calculate-cost');
