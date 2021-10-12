<?php

namespace Database\Factories;

use App\Models\Ciudade;
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
            "nombre" => $this->faker->company(),
            "direccion" => $this->faker->address(),
            "telefono" => $this->faker->phoneNumber(),
            "ciudade_id" => Ciudade::inRandomOrder()->first()->id,
            "estado" => $this->faker->randomElement([0,1])
        ];
    }
}
