<?php

namespace App\Http\Controllers;

use App\Models\Bodega;
use App\Models\DetalleMovimiento;
use App\Models\Movimiento;
use Illuminate\Http\Request;

class BodegaController extends Controller
{

    public function index()
    {
        return array_reverse(Bodega::all()->toArray());
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'nombre' => 'required|min:4|max:45',
        //     'direccion' => 'required|min:6|max:255'
        // ]);
        // $bodega = Bodega::create($request->all());
        // return $bodega;


        $bodega = new Bodega;
        $movimiento = new Movimiento;
        $detalle_movimiento = new DetalleMovimiento;

        $detalle_movimientos = collect($request->items)->transform(function ($detalle) {
            $detalle["producto_id"] = $detalle["producto"]["id"];
            $detalle["bodega_id"] = $detalle["bodega"]["id"];
            return new DetalleMovimiento($detalle);
        });

        // if ($detalle_movimientos->isEmpty()) {
        //     return response()
        //         ->json([
        //             'detalle_empty' => ['One or more Product is required.']
        //         ], 422);
        // }

        $bodega = DB::transaction(function () use ($bodega, $detalle_movimientos) {
            $movimiento->save();
            $movimiento->detalle_movimientos()->saveMany($detalle_movimientos);
        });
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
