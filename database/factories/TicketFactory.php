<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'flight_id' => \App\Models\Flight::factory(),
            'seat_number' => $this->faker->randomElement(range('A', 'Z')) . $this->faker->randomDigit(),
            'price' => $this->faker->randomFloat(2, 50, 500),
            'holder_id' => $this->faker->randomElement(range(1, 10)),
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
