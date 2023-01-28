<?php

namespace Database\Factories\Species;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SpeciesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'classification' => $this->faker->name(),
            'designation' => $this->faker->name(),
            'average_height' => $this->faker->numberBetween(100, 200),
            'skin_colors' => $this->faker->colorName(),
            'hair_colors' => $this->faker->colorName(),
            'eye_colors' => $this->faker->colorName(),
            'average_lifespan' => $this->faker->numberBetween(100, 1000),
            'language' => $this->faker->languageCode(),
        ];
    }
}
