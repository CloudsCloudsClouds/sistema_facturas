<?php

namespace Database\Seeders;

use App\Models\Campus;
use App\Models\Career;
use App\Models\Person;
use App\Models\Student;
use App\Models\Term;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuarios
        User::factory(1)->create();

        Person::factory(250)->create();

        // Llamar a los seeders específicos
        $this->call([
            CampusSeeder::class,
            CareerSeeder::class,
            TermSeeder::class,
            PaymentPlanSeeder::class,
        ]);

        // Crear personas (puede depender de User, Campus o Career)
        Student::factory(250)->create();

        // Si Student depende de otros modelos, crea Student después de haber creado las dependencias
        // Student::factory(50)->create();
    }
}
