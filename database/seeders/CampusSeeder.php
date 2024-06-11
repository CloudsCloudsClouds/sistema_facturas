<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Campus;

class CampusSeeder extends Seeder
{
    public function run()
    {
        $campuses = [
            [
                "name" => 'Campus La Paz',
                "direction" => 'C. Héroes del Acre esq. Landaeta, No. 1855',
                "number" => '72023085',
                "email" => 'unifranz@unifranz.edu.bo'
            ],
            [
                "name" => 'Campus Cochabamba',
                "direction" => 'Av. Villarroel esq. c. Portales, No. 359',
                "number" => '7202378',
                "email" => 'unifranz@unifranz.edu.bo'
            ],
            [
                "name" => 'Campus Santa Cruz',
                "direction" => 'Av. Busch esq. 2do Anillo, No. 1113',
                "number" => '72023768',
                "email" => 'unifranz@unifranz.edu.bo'
            ],
            [
                "name" => 'Campus El Alto',
                "direction" => 'Av. del Aeropuerto Internacional El Alto, No. 1015',
                "number" => '72023768',
                "email" => 'unifranz@unifranz.edu.bo'
            ],
            // Agrega más sedes si es necesario
        ];

        foreach ($campuses as $campus) {
            Campus::create($campus);
        }
    }
}
