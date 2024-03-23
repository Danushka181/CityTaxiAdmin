<?php

namespace App\Http\Controllers\Drivers;

use App\Http\Controllers\Controller;
use App\Models\DriversAvailability;
use Illuminate\Http\Request;

class AvailableDrivers extends Controller
{
    // get all available drivers
    public function allAvailableDrivers()
    {
        $drivers = DriversAvailability::with('driver')->get();
        return response()->json($drivers);
    }

    // add available driver to data table
    public static function addAvailableDriver( $id )
    {
        $availableDriver = DriversAvailability::where('driver_id', $id)->first();
        if ( $availableDriver ) {
            return $availableDriver;
        }else {
            return DriversAvailability::create([
                'driver_id' => $id,
                'is_active' => 1
            ]);
        }
    }

    // remove available driver from data table
    public static function removeAvailableDriver( $id ): bool
    {
        $availableDriver = DriversAvailability::where('driver_id', $id)->first();
        if ( $availableDriver ) {
            $availableDriver->delete();
            return true;
        }else{
            return false;
        }
    }

}
