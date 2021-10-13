<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriaResource;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        return CategoriaResource::collection(Categoria::latest()->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            "nombre" => "required|min:2|max:20",
            "descripcion" => "required|min:10|max:255"
        ]);
        Categoria::create($request->all());
    }

    public function show(Categoria $categoria)
    {
        return $categoria;
    }

    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            "nombre" => "required|min:2|max:20",
            "descripcion" => "required|min:10|max:255"
        ]);
        $categoria->update($request->all());
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->estado = !$categoria->estado;
        $categoria->save();
    } 
}
