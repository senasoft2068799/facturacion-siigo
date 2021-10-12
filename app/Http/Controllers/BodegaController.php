<?php

namespace App\Http\Controllers;

use App\Http\Resources\BodegaResource;
use App\Models\Bodega;
use Illuminate\Http\Request;

class BodegaController extends Controller
{

    public function index()
    {
        return BodegaResource::collection(Bodega::latest()->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:4|max:45',
            'direccion' => 'required|min:6|max:255',
            "sucursale_id" => "required|exists:sucursales,id",
            "productos" => "array",
            "productos.*.id" => "required_with:productos|exists:productos,id",
        ]);

        $bodega = Bodega::create($request->except('productos'));
        $bodega->productos()->sync(array_column($request->productos, "id"));
    }

    public function show(Bodega $bodega)
    {
        return new BodegaResource($bodega);
    }

    public function update(Request $request, Bodega $bodega)
    {
        $request->validate([
            'nombre' => 'required|min:4|max:45',
            'direccion' => 'required|min:6|max:255',
            "sucursale_id" => "required|exists:sucursales,id",
            "productos" => "array",
            "productos.*.id" => "required_with:productos|exists:productos,id",
        ]);
        //Falta el mensaje personalizado productos.*.id
        $bodega->update($request->except('productos', "sucursal", "created_at", "updated_at"));
        $bodega->productos()->sync(array_column($request->productos, "id"));
    }

    public function destroy(Bodega $bodega)
    {
        $bodega->estado = !$bodega->estado;
        $bodega->save();
    }
}
