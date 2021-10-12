<?php

namespace Tests\Feature;

use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriaCrudTest extends TestCase
{
    //Es importante que tenga la etiquita de abajo para que Laravel verifique que es una prueba
    /** @test */
    public function a_categoria_can_be_created()
    {
        $this->withoutExceptionHandling(); //Esta linea de código permite ver los errores sin excepciones

        $response = $this->put('/categoria', [
            'nombre' => 'Categoria Prueba',
            'descripcion' => 'Categoria Descripcion'
        ]);

        $response->assertOk();
        $this->assertCount(1, Categoria::all());

        $categoria = Categoria::first();

        $this->assertEquals($categoria->nombre, 'Categoria Prueba');
        $this->assertEquals($categoria->descripcion, 'Categoria Descripcion');
    }
}
