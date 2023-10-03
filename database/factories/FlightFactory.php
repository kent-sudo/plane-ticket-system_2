<?php

// FlightFactory.php

namespace Database\Factories;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlightFactory extends Factory
{
    protected $model = Flight::class;

    public function definition()
    {
        return [
            'flight_number' => $this->faker->lexify('??') . ' ' . $this->faker->numberBetween(1000, 9999),
            'departure_time' => $this->faker->dateTimeBetween('now', '+1 week'),
            'arrival_time' => $this->faker->dateTimeBetween('now', '+2 weeks'),
            'destination' => $this->faker->city,
            'departure_location' => $this->faker->city,
        ];
    }
}
