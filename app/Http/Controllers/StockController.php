<?php

namespace App\Http\Controllers;

use App\Http\Resources\StockResource;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        return StockResource::collection(Stock::all()->sortBy('bodega.nombre'));
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, Stock $stock)
    {
        $request->producto_id = $request->producto['id'];
        $request->bodega_id = $request->bodega['id'];
        $stock->update($request->except('producto', 'bodega', 'entrada'));
    }
}
