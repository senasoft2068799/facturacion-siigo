<?php

namespace Database\Factories;

use App\Models\Producto;
use App\Models\Categoria;
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
            "nombre" => $this->faker->unique->sentence(2, false),
            "precio_unitario" => $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
            "imagen" => $this->faker->imageUrl(512, 512, 'cats'),
            "categoria_id" => Categoria::inRandomOrder()->first()->id,
            "estado" => $this->faker->randomElement([0,1])
        ];
    }
}
