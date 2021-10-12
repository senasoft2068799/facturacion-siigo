<?php

namespace App\Http\Controllers;

use App\Http\Resources\StockResource;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        return StockResource::collection(Stock::latest()->get());
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, Stock $stock)
    {
        $stock->update($request->all());
    }
}
