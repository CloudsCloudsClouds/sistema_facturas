<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "first_name"=>fake()->firstName(),
            "second_name"=>fake()->firstName(),
            "middle_name"=>fake()->lastName(),
            "last_name"=>fake()->lastName(),
            "number"=>fake()->phoneNumber(),
            "direction"=>fake()->streetAddress(),
            "email"=>fake()->freeEmail(),
            "ci"=>fake()->randomNumber(7, true),
        ];
    }
}
