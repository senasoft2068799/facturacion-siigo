<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->randomNumber(9, true),
            'tipo_documento' => $this->faker->randomElement([
                "NIT", // NIT Empresa
                "CC", // Cedula ciudadanía
                "TI", // Tarjeta identidad
                "TP", // Tarjeta pasaporte
                "RC", // Registro civil 
                "CE", // Cedula extrangería 
                "DNI", // Documento nacional de identidad
            ]),
            'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'telefono' => $this->faker->e164PhoneNumber(),
            'password' => '$10$uyEvh1moLpdhXdNKYV2qCu01LQ4qRhqVjYe7FCGrGUWRlLEorZFEi', // password: 12345678
            'remember_token' => Str::random(10),
            'estado' => $this->faker->randomElement([0, 1]),
            'role_id' => Role::inRandomOrder()->first()->id,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
