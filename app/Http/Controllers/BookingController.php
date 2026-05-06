<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\Guest;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the bookings.
     */
    public function index()
    {
        $bookings = Booking::with(['room', 'guest'])
            ->latest()
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new booking.
     */
    public function create()
    {
        $rooms = Room::orderBy('room_number')->get();
        $guests = Guest::orderBy('name')->get();

        return view('bookings.create', compact('rooms', 'guests'));
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(StoreBookingRequest $request)
    {
        $validated = $request->validated();

        // Calculate total cost automatically
        $validated['total_cost'] = Booking::calculateTotalCost(
            $validated['room_id'],
            $validated['check_in'],
            $validated['check_out']
        );

        Booking::create($validated);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking created successfully. Total cost: $'.number_format($validated['total_cost'], 2));
    }

    /**
     * Display the specified booking.
     */
    public function show(Booking $booking)
    {
        $booking->load(['room', 'guest']);

        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified booking.
     */
    public function edit(Booking $booking)
    {
        $rooms = Room::orderBy('room_number')->get();
        $guests = Guest::orderBy('name')->get();

        return view('bookings.edit', compact('booking', 'rooms', 'guests'));
    }

    /**
     * Update the specified booking in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $validated = $request->validated();

        // Recalculate total cost if room or dates changed
        if (
            $validated['room_id'] != $booking->room_id ||
            $validated['check_in'] != $booking->check_in ||
            $validated['check_out'] != $booking->check_out
        ) {
            $validated['total_cost'] = Booking::calculateTotalCost(
                $validated['room_id'],
                $validated['check_in'],
                $validated['check_out']
            );
        }

        $booking->update($validated);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified booking from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }

    /**
     * AJAX endpoint to calculate booking cost.
     */
    public function calculateCost(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        $totalCost = Booking::calculateTotalCost(
            $request->room_id,
            $request->check_in,
            $request->check_out
        );

        $room = Room::find($request->room_id);
        $nights = Carbon::parse($request->check_in)
            ->diffInDays(Carbon::parse($request->check_out));

        return response()->json([
            'total_cost' => $totalCost,
            'nights' => $nights,
            'price_per_night' => $room->price_per_night,
        ]);
    }
}
