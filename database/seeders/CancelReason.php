<?php

namespace Database\Seeders;

use App\Models\CancelReasons;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CancelReason extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $reasons = [
            'Driver not available',
            'Driver not responding',
            'Driver not moving',
            'Driver not moving towards the pickup location',
            'Driver not moving towards the drop off location',
            'Driver is in another trip',
        ];

        foreach ($reasons as $reason) {
            CancelReasons::create(
                ['reason' => $reason]
            );
        }
    }
}
