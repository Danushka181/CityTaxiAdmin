<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use App\Models\Vehicles;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VehicleController extends Controller
{
    public static function getTotalVehicles()
    {
        return Vehicles::count();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all vehicles from the database with drivers
        $vehicles = Vehicles::with('driver','car_type')->get();
        return Inertia::render('Vehicle/Index', [
            'vehicles' => $vehicles
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

        $vehicle = Vehicles::find($id)->with('driver','car_type')->first();
        return Inertia::render('Vehicle/Show', [
            'vehicle' => $vehicle
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
