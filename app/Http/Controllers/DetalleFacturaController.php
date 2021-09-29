<?php

namespace App\Http\Controllers;

use App\Models\DetalleMovimiento;
use Illuminate\Http\Request;

class DetalleFacturaController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(DetalleMovimiento $detalleMovimiento)
    {
        //
    }

    public function update(Request $request, DetalleMovimiento $detalleMovimiento)
    {
        //
    }

    public function destroy(DetalleMovimiento $detalleFactura)
    {
        $detalleFactura->delete();
    }
}
