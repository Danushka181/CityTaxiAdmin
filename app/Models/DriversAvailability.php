<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriversAvailability extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'drivers_availability';

    public function driver()
    {
        return $this->belongsTo(Drivers::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicles::class);
    }
}
