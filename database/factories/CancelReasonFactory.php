<?php

namespace Database\Factories;

use App\Models\CancelReasons;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CancelReasons>
 */
class CancelReasonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reason' => $this->faker->sentence(),
        ];
    }
}
