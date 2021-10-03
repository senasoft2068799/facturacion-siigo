<?php

namespace App\Http\Controllers;

use App\Http\Resources\FacturaResource;
use App\Models\DetalleMovimiento;
use App\Models\Movimiento;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FacturaController extends Controller
{
    public function index()
    {
        return FacturaResource::collection(Movimiento::where("documento_id", 1)->latest()->get());
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'descripcion' => 'max:255',
        //     'valor_total' => 'required',
        //     'documento_id' => 'required|exists:documentos,id',
        //     'sucursale_id' => 'required|exists:sucursales,id',
        //     'user_id' => 'required|exists:users,id',
        //     "estado" => ["required", Rule::in([1, 2])]
        // ]);

        // $factura = Movimiento::create($request->all());
        // return new FacturaResource($factura);
        $movimiento = new Movimiento;
        $movimiento->fill($request->except("items"));

        $movimiento->save();
        // for ($i = 1; $i < 3; $i++) {
        //     $containers[] =  new DetalleMovimiento([
        //         "cantidad" => $i,
        //         "valor" => $i * 10,
        //         "bodega_id" => $i,
        //         "producto_id" => $i
        //     ]);
        $movimiento->detalle_movimientos()->saveMany($request->items);
    }

    public function updateHasMany($relations, $factura)
    {
        foreach ($relations as $key => $items) {
            $newItems = [];

            foreach ($items as $item) {
                $model = $this->{$key}();
                $newItems[] = $model->fill($item);
            }

            //save
            // $this->{$key}()->saveMany($newItems);
        }
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
