<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacturaRequest;
use App\Http\Resources\FacturaResource;
use App\Models\DetalleMovimiento;
use App\Models\Movimiento;
use App\Models\Stock;
use App\Models\User;
use App\Notifications\LimiteStock;
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


            $stock = Stock::where("producto_id", $detalle["producto_id"])
                ->where("bodega_id", $detalle["bodega_id"])->get()->first();
            $stock->cantidad -= $detalle["cantidad"];
            if ($stock->cantidad <= 10) {
                $admins = User::where("role_id", 1)->orWhere("role_id", 3)->get();
                Notification::send($admins, new LimiteStock($stock->producto, $stock->bodega));
            }
            $stock->save();

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

    public function update(Request $request, Movimiento $factura)
    {
        $detalle_movimientos = collect($request->detalle_movimientos)->transform(function ($detalle) {
            $det["producto_id"] = $detalle["producto"]["id"];
            $det["bodega_id"] = $detalle["bodega"]["id"];
            $det["cantidad"] = $detalle["cantidad"];
            $det["valor_total"] = $detalle["valor_total"];



            // $stock = Stock::where("producto_id", $detalle["producto_id"])
            //     ->where("bodega_id", $detalle["bodega_id"])->get()->first();
            // $stock->cantidad -= $detalle["cantidad"];
            // if ($stock->cantidad <= 10) {
            //     $admins = User::where("role_id", 1)->orWhere("role_id", 3)->get();
            //     Notification::send($admins, new LimiteStock($stock->producto, $stock->bodega));
            // }
            // $stock->save();

            return new DetalleMovimiento($det);
        });

        $movimiento = DB::transaction(function () use ($factura, $detalle_movimientos, $request) {

            // $movimiento->detalle_movimientos()->updateMany($detalle_movimientos);
            // $admins = User::where("role_id", 1)->get();
            // Notification::send($admins, new OrdenFactura($movimiento, $movimiento->user));
            $factura->update([
                "descripcion" => $request->descripcion,
                "valor_total" => $request->valor_total,
                "sucursale_id" => $request->sucursal["id"],
            ]);
            DetalleMovimiento::where("movimiento_id", $factura->id)->delete();
            $factura->detalle_movimientos()->saveMany($detalle_movimientos);
        });


        //  return response()
        //      ->json([
        //          "created" => true,
        //           "id" => $movimiento->id
        //       ], 422);
    }

    public function destroy(Movimiento $factura)
    {
        $factura->estado = !$factura->estado;
        $factura->save();
    }
}
