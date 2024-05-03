<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriversAvailability extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'driver_availabilities';

    public function driver()
    {
        return $this->belongsTo(Drivers::class, 'driver_id', 'id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicles::class);
    }
}
