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
            "sucursale_id" => "required|exists:sucursales,id"
        ]);

        Bodega::create($request->all());

        // $sucursale = Sucursale::find($request->sucursale_id);
        // $sucursale->bodegas()->save($bodega);
    }

    public function show(Bodega $bodega)
    {
        return $bodega;
    }

    public function update(Request $request, Bodega $bodega)
    {
        $bodega->update($request->all());
    }

    public function destroy(Bodega $bodega)
    {
        $bodega->delete();
    }
}
