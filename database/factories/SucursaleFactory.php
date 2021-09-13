<?php

namespace Database\Factories;

use App\Models\Sucursale;
use Illuminate\Database\Eloquent\Factories\Factory;

class SucursaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sucursale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nombre" => $this->faker->sentence(2),
            "direccion" => $this->faker->sentence(),
            "telefono" => $this->faker->randomNumber(9),
        ];
    }
}
