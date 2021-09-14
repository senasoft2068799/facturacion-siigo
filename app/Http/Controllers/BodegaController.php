<?php

namespace App\Http\Controllers;

use App\Models\Bodega;
use Illuminate\Http\Request;

class BodegaController extends Controller
{

    public function index()
    {
        //        $documentos = Documento::all()->toArray();
        //return array_reverse($documentos);
        return Bodega::all()->toArray();
    }

    public function store(Request $request)
    {
        //Documento::create($request->all());
        Bodega::create($request->all());
    }

    public function edit(Bodega $bodega)
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
