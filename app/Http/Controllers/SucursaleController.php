<?php

namespace App\Http\Controllers;

use App\Models\Sucursale;
use Illuminate\Http\Request;

class SucursaleController extends Controller
{
   
    public function index()
    {
        $sucursales = Sucursale::all()->toArray();
        return array_reverse($sucursales);
    }

    public function store(Request $request)
    {
        Sucursale::create($request->all());
    }

    public function edit(Sucursale $sucursale)
    {
        return $sucursale;
    }

    public function update(Request $request, Sucursale $sucursale)
    {
        $sucursale->update($request->all());
    }

    public function destroy(Sucursale $sucursale)
    {
        $sucursale->delete();
    }
}
