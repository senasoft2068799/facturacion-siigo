<?php

namespace Database\Factories;

use App\Models\Documento;
use App\Models\Movimiento;
use App\Models\Sucursale;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovimientoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movimiento::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "descripcion" => $this->faker->sentence(),
            "documento_id" => Documento::inRandomOrder()->first()->id,
            "sucursale_id" => Sucursale::inRandomOrder()->first()->id,
            "user_id" => User::inRandomOrder()->first()->id,
            "valor_total" => $this->faker->randomFloat(),
            "estado" => $this->faker->randomElement($array = array(1, 2,)),
        ];
    }
}
