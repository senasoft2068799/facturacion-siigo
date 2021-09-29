<?php

namespace App\Http\Controllers;

use App\Http\Resources\FacturaResource;
use App\Models\Movimiento;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function index()
    {
        return FacturaResource::collection(Movimiento::where("documento_id", 1)->latest()->get());
    }

    public function store(Request $request)
    {
        Movimiento::create($request->all());
    }

    public function show(Movimiento $factura)
    {
        return new FacturaResource($factura);
    }

    public function update(Request $request, Movimiento $movimiento)
    {
        //
    }

    public function destroy(Movimiento $factura)
    {
        $factura->delete();
    }
}
