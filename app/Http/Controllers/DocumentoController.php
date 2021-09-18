<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{

    public function index()
    {
        return array_reverse(Documento::all()->toArray());
    }

    public function store(Request $request)
    {
        Documento::create($request->all());
    }

    public function show(Documento $documento){
        return $documento;
    }

    public function update(Request $request, Documento $documento)
    {
        $documento->update($request->all());
    }

    public function destroy(Documento $documento)
    {
        $documento->delete();
    }
}
