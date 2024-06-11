<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Person;

class PersonFactory extends Factory
{
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $maleFirstNames = ['Juan', 'Carlos', 'Luis', 'Pedro', 'Jose', 'Miguel',
            'Sergio', 'Diego', 'Eduardo', 'Adrian', 'Rodrigo', 'Manuel', 'Francisco', 'Martin', 'Andres', 'Pablo',
            'Esteban', 'Antonio', 'Rafael', 'Gabriel', 'Hugo', 'Julio', 'Oscar', 'Raul', 'Vicente', 'Mauricio',
            'Gustavo', 'Armando', 'Mario', 'Enrique', 'Felipe', 'Arturo', 'Ramon', 'Jaime', 'Cristian', 'Sebastian',
            'Jorge', 'David', 'Nicolas', 'Ivan', 'Tomas', 'Ignacio', 'Benjamin', 'Felix', 'Federico', 'Emilio'];

        $femaleFirstNames = ['Ana', 'Maria', 'Gabriela', 'Rosa', 'Laura', 'Lucia',
            'Valeria', 'Andrea', 'Sofia', 'Camila', 'Isabel', 'Marta', 'Beatriz', 'Elena', 'Julia', 'Susana',
            'Carmen', 'Alicia', 'Silvia', 'Diana', 'Lorena', 'Monica', 'Eva', 'Cristina', 'Patricia', 'Carla',
            'Adriana', 'Mariana', 'Natalia', 'Bianca', 'Ariana', 'Victoria', 'Gabriela', 'Daniela', 'Renata', 'Vanessa',
            'Gloria', 'Nadia', 'Ines', 'Sara', 'Liliana', 'Elsa', 'Irene', 'Sonia', 'Teresa', 'Ruth'];

        $lastNames = ['Gonzalez', 'Rodriguez', 'Lopez', 'Perez', 'Garcia', 'Martinez', 'Sanchez', 'Ramirez', 'Cruz', 'Flores',
            'Vargas', 'Diaz', 'Fernandez', 'Morales', 'Rojas', 'Castro', 'Ortiz', 'Suarez', 'Guzman', 'Vega',
            'Torres', 'Reyes', 'Mendoza', 'Molina', 'Paz', 'Aguilar', 'Salazar', 'Romero', 'Herrera', 'Navarro',
            'Ramos', 'Jimenez', 'Chavez', 'Mendez', 'Cabrera', 'Leon', 'Campos', 'Gutierrez', 'Paredes', 'Quispe',
            'Arias', 'Loaiza', 'Escobar', 'Rivas', 'Espinoza', 'Salinas', 'Peralta', 'Arce', 'Benitez', 'Huanca'];

        $gender = $this->faker->randomElement(['male', 'female']);
        $firstName = $gender === 'male' ? $this->faker->randomElement($maleFirstNames) : $this->faker->randomElement($femaleFirstNames);
        $secondName = $gender === 'male' ? $this->faker->randomElement($maleFirstNames) : $this->faker->randomElement($femaleFirstNames);

        // Generar apellidos sin restricción de unicidad
        $middleName = $this->faker->randomElement($lastNames);
        $lastName = $this->faker->randomElement($lastNames);

        // Construir el correo electrónico con las iniciales de los nombres y apellidos
        $email = strtolower(substr($firstName, 0, 2) . substr($secondName, 0, 2) . '.' . $this->faker->unique()->numerify('####') . '@unifranz.edu.bo');

        return [
            'first_name' => $firstName,
            'second_name' => $secondName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
            'number' => $this->faker->unique()->numerify('7#######'), // Número de 8 dígitos
            'direction' => $this->faker->streetAddress(),
            'email' => $email,
            'ci' => $this->faker->unique()->numerify('########'), // CI de 8 dígitos
        ];
    }
}
