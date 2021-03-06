<?php

namespace Database\Factories;

use App\Models\Ciudade;
use Illuminate\Database\Eloquent\Factories\Factory;

class CiudadeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ciudade::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nombre" => $this->faker->unique->city()
        ];
    }
}
