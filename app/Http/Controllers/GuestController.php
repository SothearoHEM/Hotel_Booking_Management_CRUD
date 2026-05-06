<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGuestRequest;
use App\Http\Requests\UpdateGuestRequest;
use App\Models\Guest;

class GuestController extends Controller
{
    /**
     * Display a listing of the guests.
     */
    public function index()
    {
        $guests = Guest::latest()->paginate(10);

        return view('guests.index', compact('guests'));
    }

    /**
     * Show the form for creating a new guest.
     */
    public function create()
    {
        return view('guests.create');
    }

    /**
     * Store a newly created guest in storage.
     */
    public function store(StoreGuestRequest $request)
    {
        Guest::create($request->validated());

        return redirect()->route('guests.index')
            ->with('success', 'Guest created successfully.');
    }

    /**
     * Display the specified guest.
     */
    public function show(Guest $guest)
    {
        $guest->load('bookings.room');

        return view('guests.show', compact('guest'));
    }

    /**
     * Show the form for editing the specified guest.
     */
    public function edit(Guest $guest)
    {
        return view('guests.edit', compact('guest'));
    }

    /**
     * Update the specified guest in storage.
     */
    public function update(UpdateGuestRequest $request, Guest $guest)
    {
        $guest->update($request->validated());

        return redirect()->route('guests.index')
            ->with('success', 'Guest updated successfully.');
    }

    /**
     * Remove the specified guest from storage.
     */
    public function destroy(Guest $guest)
    {
        $guest->delete();

        return redirect()->route('guests.index')
            ->with('success', 'Guest deleted successfully.');
    }
}
