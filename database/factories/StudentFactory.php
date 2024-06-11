<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Student;
use App\Models\Person;
use App\Models\PaymentPlan;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->randomNumber(8),
            'email' => $this->faker->unique()->safeEmail,
            'person_id' => Person::factory()->create()->id,
            'payment_plan_id' => PaymentPlan::inRandomOrder()->first()->id,
        ];
    }
}
