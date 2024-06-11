<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Campus;
use App\Models\Career;

class CareerSeeder extends Seeder
{
    public function run()
    {
        $careers = [
            [
                "name" => 'Enfemeria',
                "duration" => 10,
                "number" => '71234567',
                "email" => 'enefermeria@unifranz.edu.bo',
            ],
            [
                "name" => 'Bioquimica y Farmacia',
                "duration" => 10,
                "number" => '71234678',
                "email" => 'bioquimicayfarmacia@unifranz.edu.bo',
            ],
            [
                "name" => 'Odontologia',
                "duration" => 10,
                "number" => '71234789',
                "email" => 'odontologia@unifranz.edu.bo',
            ],
            [
                "name" => 'Medicina',
                "duration" => 12,
                "number" => '71234910',
                "email" => 'medicina@unifranz.edu.bo',
            ],
            [
                "name" => 'Administracion de Empresas',
                "duration" => 8,
                "number" => '71234231',
                "email" => 'administraciondeempresas@unifranz.edu.bo',
            ],
            [
                "name" => 'Hoteleria y Turismo',
                "duration" => 8,
                "number" => '71234452',
                "email" => 'hoteleriayturismo@unifranz.edu.bo',
            ],
            [
                "name" => 'Contaduria Publica',
                "duration" => 8,
                "number" => '71234673',
                "email" => 'contaduriapublica@unifranz.edu.bo',
            ],
            [
                "name" => 'Ingenieria Comercial',
                "duration" => 8,
                "number" => '71234893',
                "email" => 'ingcomercial@unifranz.edu.bo',
            ],
            [
                "name" => 'Ingenieria Economica',
                "duration" => 8,
                "number" => '71231123',
                "email" => 'ingeconomica@unifranz.edu.bo',
            ],
            [
                "name" => 'Economica y Financiera',
                "duration" => 8,
                "number" => '71234533',
                "email" => 'ingeconomicayfinanciera@unifranz.edu.bo',
            ],
            [
                "name" => 'Derecho',
                "duration" => 8,
                "number" => '71239873',
                "email" => 'derecho@unifranz.edu.bo',
            ],
            [
                "name" => 'Periodismo',
                "duration" => 8,
                "number" => '71234098',
                "email" => 'periodismo@unifranz.edu.bo',
            ],
            [
                "name" => 'Psicologia',
                "duration" => 8,
                "number" => '71234471',
                "email" => 'psicologia@unifranz.edu.bo',
            ],
            [
                "name" => 'Arquitectura',
                "duration" => 10,
                "number" => '71235439',
                "email" => 'arquitectura@unifranz.edu.bo',
            ],
            [
                "name" => 'Diseño Grafico y Procuccion Crossmedia',
                "duration" => 8,
                "number" => '712312365',
                "email" => 'diseñograficoycrossmedia@unifranz.edu.bo',
            ],
            [
                "name" => 'Plublicidad y Marketing',
                "duration" => 8,
                "number" => '71212345',
                "email" => 'plublicidadymarketing@unifranz.edu.bo',
            ],
            [
                "name" => 'Ingenieria en Sistemas',
                "duration" => 9,
                "number" => '71230986',
                "email" => 'ingensistemas@unifranz.edu.bo',
            ],
        ];

        foreach ($careers as $career) {
            Career::create([
                "campus_id" => Campus::query()->inRandomOrder()->first()?->id ?? Campus::factory()->create()->id,
                "name" => $career['name'],
                "duration" => $career['duration'],
                "number" => $career['number'],
                "email" => $career['email'],
            ]);
        }
    }
}
