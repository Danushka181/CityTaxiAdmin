<?php

namespace App\Http\Controllers\Trips;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Drivers\AvailableDrivers;
use App\Models\DriversAvailability;
use App\Models\Trips;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TripsManageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allCompletedTrips  = Trips::where('status', 'Completed')->get();
        $allPendingTrips    = Trips::where('status', 'Begin trip')->get();
        $allCancelledTrips  = Trips::where('status', 'Cancelled')->get();
        $allTrips = Trips::with('driver', 'passenger', 'vehicle')->get();

        // Trips index
        return Inertia::render('Trips/Index', [
            'allCompletedTrips' => $allCompletedTrips,
            'allPendingTrips' => $allPendingTrips,
            'allCancelledTrips' => $allCancelledTrips,
            'allTrips' => $allTrips
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Trips/Create', [
            'drivers' => DriversAvailability::with('driver')->get()
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Inertia::render('Trips/Show', [
            'trip' => Trips::with('driver', 'passenger')->find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
