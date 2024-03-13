<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trips extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function driver()
    {
        return $this->belongsTo(Drivers::class);
    }

    public function passenger()
    {
        return $this->belongsTo(Passengers::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicles::class);
    }

    public function payment()
    {
        return $this->hasOne(Payments::class);
    }

}
