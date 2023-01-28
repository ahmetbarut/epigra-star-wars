<?php

namespace Database\Factories\People;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\People\People>
 */
class PeopleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Create fields by 2023_01_25_190736_create_people_table.php migration

        $gender = ['male', 'female'];
        return [
            'birth_year' => $this->faker->year(),
            'eye_color' => $this->faker->colorName(),
            'gender' => $gender[array_rand($gender, 1)],
            'hair_color' => $this->faker->colorName(),
            'height' => $this->faker->numberBetween(100, 200),
            'homeworld' =>  $this->faker->url(),
            'mass' =>  $this->faker->numberBetween(50, 100),
            'name' => $this->faker->name(),
            'skin_color' => $this->faker->colorName(),
        ];
    }
}
