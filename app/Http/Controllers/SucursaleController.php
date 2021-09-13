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

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Sucursale $sucursale)
    {
        //
    }

    public function edit(Sucursale $sucursale)
    {
        //
    }

    public function update(Request $request, Sucursale $sucursale)
    {
        //
    }

    public function destroy(Sucursale $sucursale)
    {
        $sucursale->delete();
    }
}
