<?php

namespace Database\Factories;

use App\Models\Bodega;
use App\Models\DetalleMovimiento;
use App\Models\Movimiento;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetalleMovimientoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetalleMovimiento::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "cantidad" => $this->faker->randomDigitNotZero(),
            "valor_total" => $this->faker->randomFloat(),
            "movimiento_id" => Movimiento::inRandomOrder()->first()->id,
            "producto_id" => Producto::inRandomOrder()->first()->id,
        ];
    }
}
