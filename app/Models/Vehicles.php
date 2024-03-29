<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function driver()
    {
        return $this->hasOne(Drivers::class, 'id', 'driver_id');
    }

    // get with car types
    public function car_type()
    {
        return $this->hasOne(CarTypes::class, 'id', 'car_type');
    }

}

