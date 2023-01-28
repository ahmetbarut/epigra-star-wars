<?php

namespace Database\Factories\Vehicle;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name(),
            "model" => $this->faker->name(),
            "manufacturer" => $this->faker->name(),
            "cost_in_credits" => $this->faker->name(),
            "length" => $this->faker->name(),
            "max_atmosphering_speed" => $this->faker->name(),
            "crew" => $this->faker->name(),
            "passengers" => $this->faker->name(),
            "cargo_capacity" => $this->faker->name(),
            "consumables" => $this->faker->name(),
            "vehicle_class" => $this->faker->name(),
            "url" => $this->faker->url(),
        ];
    }
}
