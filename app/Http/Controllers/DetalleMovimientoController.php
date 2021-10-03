<?php

namespace App\Http\Controllers;

use App\Http\Resources\DetalleMovimientoResource;
use App\Models\DetalleMovimiento;
use Illuminate\Http\Request;

class DetalleMovimientoController extends Controller
{
    public function index()
    {
        return DetalleMovimientoResource::collection(DetalleMovimiento::latest()->get());
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'cantidad' => 'required',
        //     'valor_total' => 'required',
        //     'movimiento_id' => 'required|exists:movimientos,id',
        //     'bodega_id' => 'required|exists:bodegas,id',
        //     'producto_id' => 'required|exists:productos,id',
        // ]);
        $detalleMovimiento = DetalleMovimiento::create($request->all());
        return $detalleMovimiento;
    }

    public function show(DetalleMovimiento $detalleMovimiento)
    {
        //
    }

    public function update(Request $request, DetalleMovimiento $detalleMovimiento)
    {
        //
    }

    public function destroy(DetalleMovimiento $detalleMovimiento)
    {
        $detalleMovimiento->delete();
    }
}
