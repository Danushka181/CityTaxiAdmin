<?php

namespace App\Http\Controllers\Passengers;

use App\Http\Controllers\Controller;
use App\Models\Passengers;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Mockery\Generator\StringManipulation\Pass\Pass;

class PassengerManageController extends Controller
{
    public static function getTotalPassengers()
    {
        return Passengers::count();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all Passengers in the Database
        $passengers = Passengers::all();

        return Inertia::render('Passenger/Index', ['passengers' => $passengers]);
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
        $driverData = $this->getPassengerDataById($id);
        return Inertia::render('Passenger/Edit', ['passenger' => $driverData]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:passengers,email,'.$id,
            'phone' => 'required|numeric|digits:10|unique:passengers,phone,'.$id,
            'address' => 'required|string|max:255',
            'identity_card' => 'required|string|max:255',
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
        ];

        $validatedData      = $request->validate($rules, $messages);
        $passenger             = $this->getPassengerDataById($id);
        $passenger->name       = $validatedData['name'];
        $passenger->email      = $validatedData['email'];
        $passenger->phone      = $validatedData['phone'];
        $passenger->address    = $validatedData['address'];
        $passenger->identity_card  = $validatedData['identity_card'];
        $passenger->is_banned  = $request->is_banned;
        $passenger->status     = $request->status;

        $passenger->save();

        return back()->with('success', 'Passenger updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function getPassengerDataById( $id )
    {
        return Passengers::find($id)->firstOrFail();
    }
}
