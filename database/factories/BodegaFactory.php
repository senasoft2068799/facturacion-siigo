<?php

namespace Database\Factories;

use App\Models\Bodega;
use App\Models\Sucursale;
use Illuminate\Database\Eloquent\Factories\Factory;

class BodegaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bodega::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nombre" => $this->faker->company(),
            "direccion" => $this->faker->streetName(),
            'estado' => $this->faker->randomElement([0,1]),
            "sucursale_id" => Sucursale::inRandomOrder()->first()->id,
        ];
    }
}
