<?php

namespace App\Http\Controllers;

use App\Http\Resources\FacturaResource;
use App\Models\DetalleMovimiento;
use App\Models\Movimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        // return $request->items[0];
        // $movimiento->save();
        // for ($i = 1; $i < 3; $i++) {
        //     $containers[] =  new DetalleMovimiento([
        //         "cantidad" => $i,
        //         "valor" => $i * 10,
        //         "bodega_id" => $i,
        //         "producto_id" => $i
        //     ]);
        // $det = new DetalleMovimiento();
        // $det->cantidad = 1;
        // $det->valor_total = 1000;
        // $det->producto_id = 2;
        // $det->bodega_id = 2;

        // return $movimiento->detalle_movimientos()->saveMany($request->detalle_movimientos);

        $movimiento = new Movimiento;
        $movimiento->fill($request->except("items"));
        $movimiento = DB::transaction(function () use ($movimiento, $request) {

            $movimiento->save();
            $detalle_movimientos = $request->get('items');

            $movimiento->detalle_movimientos()->createMany($detalle_movimientos);
            // $movimiento->detalle_movimientos()->saveMany($request->items);
            // //custom method from app/Helper/HasManyRelation
            // $movimiento->storeHasManyy([
            //     'items' => $request->items
            // ]);

            // return $movimiento;
        });
        // return $request->items[0];
    }

    public function storeHasManyy($relations)
    {
        $this->save();

        foreach ($relations as $key => $items) {
            $newItems = [];

            foreach ($items as $item) {
                $model = $this->{$key}()->getModel();
                $newItems[] = $model->fill($item);
            }

            //save
            $this->{$key}()->saveMany($newItems);
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
