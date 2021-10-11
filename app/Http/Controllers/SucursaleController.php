<?php

namespace App\Http\Controllers;

use App\Http\Resources\SucursaleResource;
use App\Models\Sucursale;
use Illuminate\Http\Request;

class SucursaleController extends Controller
{

    public function index()
    {
        //$sucursales = Sucursale::all()->toArray();
        //return array_reverse($sucursales);
        return SucursaleResource::collection(Sucursale::latest()->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            "nombre" => "required|min:2|max:45",
            "direccion" => "required|min:6|max:255",
            "telefono" => "required|numeric|digits_between:6,20",
            "ciudade_id" => "required|exists:ciudades,id",
        ]);
        Sucursale::create($request->all());
    }

    public function show(Sucursale $sucursale)
    {
        return $sucursale;
    }

    public function update(Request $request, Sucursale $sucursale)
    {
        $sucursale->update($request->all());
    }

    public function activar(Sucursale $sucursale)
    {
        $sucursale->estado_sucursale = 1;
        $sucursale->save(); 
    }

    public function destroy(Sucursale $sucursale)
    {
        $sucursale->estado_sucursale = 0;
        $sucursale->save(); 
    }
}
