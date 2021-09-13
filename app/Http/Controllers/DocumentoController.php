<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{

    public function index()
    {
        $documentos = Documento::all()->toArray();
        return array_reverse($documentos);
    }

    public function store(Request $request)
    {
        Documento::create($request->all());
    }

    public function edit(Documento $documento){
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
