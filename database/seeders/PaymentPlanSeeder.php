<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Campus;
use App\Models\Career;
use App\Models\PaymentPlan;
use App\Models\Term;

class PaymentPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Campus::create([
            'name' => 'Campus 1',
            'direction' => 'Dirección 1',
            'number' => '123456',
            'email' => 'asdf@asdf.com'
        ]);

        Career::create([
            'campus_id' => 1,
            'name' => 'Ingeniería en Sistemas',
            'duration' => 5,
            'number' => '123456',
            'email' => 'asdf@asdfcampus.com'
        ]);

        Term::create([
            'period' => '2024-1',
            'beginning' => '2024-01-01',
            'end' => '2024-06-30'
        ]);

        PaymentPlan::create([
            'career_id' => 1,
            'term_id' => 1,
            'tuition' => 1000,
            'identifier' => '2024-1',
        ]);

        PaymentPlan::create([
            'career_id' => 1,
            'term_id' => 1,
            'tuition' => 500,
            'identifier' => '2024-1',
        ]);
   }
}
