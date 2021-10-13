<?php

namespace Tests\Unit;

use App\Models\Categoria;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;

class CategoriaTest extends TestCase
{
    public function test_a_categoria_has_many_productos()
    {
        $categoria = new Categoria;
        $this->assertInstanceOf(Collection::class, $categoria->producto);
    }
}
