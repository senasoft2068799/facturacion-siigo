<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacturaRequest;
use App\Http\Resources\FacturaResource;
use App\Models\DetalleMovimiento;
use App\Models\Movimiento;
use App\Models\User;
use App\Notifications\OrdenFactura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class FacturaController extends Controller
{
    public function index()
    {
        return FacturaResource::collection(Movimiento::where("documento_id", 1)->latest()->get());
    }

    public function store(FacturaRequest $request)
    {
        $movimiento = new Movimiento;
        $movimiento->fill($request->except("items"));

        $detalle_movimientos = collect($request->items)->transform(function ($detalle) {
            $detalle["producto_id"] = $detalle["producto"]["id"];
            $detalle["bodega_id"] = $detalle["bodega"]["id"];

            return new DetalleMovimiento($detalle);
        });

        // if ($detalle_movimientos->isEmpty()) {
        //     return response()
        //         ->json([
        //             "detalle_empty" => ["One or more Product is required."]
        //         ], 422);
        // }

        $movimiento = DB::transaction(function () use ($movimiento, $detalle_movimientos) {
            $movimiento->save();
            $movimiento->detalle_movimientos()->saveMany($detalle_movimientos);
            $admins = User::where("role_id", 1)->get();
            Notification::send($admins, new OrdenFactura($movimiento, $movimiento->user));
        });

        // return response()
        //     ->json([
        //         "created" => true,
        //         "id" => $movimiento->id
        //     ]);


        // return $request->items[0];
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
        $factura->estado = !$factura->estado;
        $factura->save(); 
    }
}
