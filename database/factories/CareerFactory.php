<?php

namespace Database\Factories;

use App\Models\Campus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Career>
 */
class CareerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "campus_id" => Campus::query()->inRandomOrder()->first()?->id ?? 
            Campus::factory(),
            "name" => 'Ingeneria de sistemas',
            "duration" => 8,
            "number"=>fake()->phoneNumber(),
            "email"=>fake()->companyEmail(),
        ];
    }
}
