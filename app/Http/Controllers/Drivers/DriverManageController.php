<?php

namespace App\Http\Controllers\Drivers;

use App\Http\Controllers\Controller;
use App\Models\Drivers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class DriverManageController extends Controller
{
    public static function getTotalDrivers()
    {
        return Drivers::count();
    }

    /**
     * Display a listing of the resource.
     */
    public function index( Request $request)
    {
        // get all the drivers
        $drivers = Drivers::all();
        return Inertia::render('Drivers/Index', ['drivers' => $drivers]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $driverData = $this->getDriverDataById($id);
        return Inertia::render('Drivers/Edit', ['driver' => $driverData]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:drivers,email,'.$id,
            'phone' => 'required|numeric|unique:drivers,phone,'.$id,
            'address' => 'required|string|max:255',
            'identity_card' => 'required|string|max:255',
            'license_number' => 'required|string|max:18',
            'hire_rate' => 'required|numeric',
        ];

        $messages = [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'phone.required' => 'The phone field is required.',
            'phone.numeric' => 'The phone must be a number.',
            'phone.digits' => 'The phone must be 10 digits.',
            'address.required' => 'The address field is required.',
            'identity_card.required' => 'The identity card field is required.',
            'license_number.required' => 'The license number field is required.',
            'hire_rate.required' => 'The hire rate field is required.',
        ];

        $validatedData      = $request->validate($rules, $messages);
        $driver             = $this->getDriverDataById($id);
        $driver->name       = $validatedData['name'];
        $driver->email      = $validatedData['email'];
        $driver->phone      = $validatedData['phone'];
        $driver->address    = $validatedData['address'];
        $driver->identity_card  = $validatedData['identity_card'];
        $driver->license_number = $validatedData['license_number'];
        $driver->hire_rate  = $validatedData['hire_rate'];
        $driver->is_banned  = $request->is_banned;
        $driver->status     = $request->status;


        $driver->save();

        $availableDriver = new AvailableDrivers();
        if ( $driver->status == 'ACTIVE' && $driver->is_banned == 0) {
            $availableDriver::addAvailableDriver($id);
        }else{
            $availableDriver::removeAvailableDriver($id);
        }

        return back()->with('success', 'Driver updated successfully.');

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy (string $id)
    {
        $driver = $this->getDriverDataById($id);
        $driver->delete();
        return back()->with('success', 'Driver deleted successfully.');
    }

    private function getDriverDataById( $id )
    {
        return Drivers::find($id);
    }
}
