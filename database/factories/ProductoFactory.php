<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Producto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nombre" => $this->faker->unique->sentence(3, false),
            "precio_unitario" => $this->faker->randomNumber(3, true),
            "imagen" => "Imagen",
            "categoria_id" => Categoria::inRandomOrder()->first()->id,
        ];
    }
}
