<?php

namespace App\Http\Controllers;

use App\Models\Bodega;
use Illuminate\Http\Request;

class BodegaController extends Controller
{

    public function index()
    {
        return array_reverse(Bodega::all()->toArray());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:4|max:45',
            'direccion' => 'required|min:6|max:255'
        ]);
        $bodega = Bodega::create($request->all());
        return $bodega;
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
