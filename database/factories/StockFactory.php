<?php

namespace Database\Factories;

use App\Models\Stock;
use App\Models\Bodega;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stock::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "cantidad" => $this->faker->randomNumber(),
            "bodega_id" => Bodega::inRandomOrder()->first()->id,
            "producto_id" => Producto::inRandomOrder()->first()->id
        ];
    }
}
