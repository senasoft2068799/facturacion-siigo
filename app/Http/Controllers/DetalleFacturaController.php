<?php

namespace App\Http\Controllers;

use App\Http\Resources\DetalleMovimientoResource;
use App\Models\DetalleMovimiento;
use Illuminate\Http\Request;

class DetalleFacturaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'cantidad' => 'required|numeric|min:0|max:255',
            'valor_total' => 'required',
            'movimiento_id' => 'required|exists:movimientos,id',
            'bodega_id' => 'required|exists:bodegas,id',
            'producto_id' => 'required|exists:productos,id',
        ]);
        $detalleMovimiento = DetalleMovimiento::create($request->all());
        return $detalleMovimiento;
    }

    public function update(Request $request, DetalleMovimiento $detalleMovimiento)
    {
        //
    }
}
