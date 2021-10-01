<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductoResource;
use App\Models\Producto;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index()
    {
        return ProductoResource::collection(Producto::latest()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $fecha = now();
        $datosProducto = $request->all();
        if($request->hasFile('imagen')){
            $datosProducto['imagen'] = $request->file('imagen')->store('public/imagenes');
        }
        $datosProducto['created_at'] = $fecha;
        $datosProducto['updated_at'] = $fecha;
        $url = Storage::url($datosProducto['imagen']);
        $datosProducto['imagen'] = $url;
        Producto::insert($datosProducto);
    }

    public function show(Producto $producto)
    {
        return $producto;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        return $producto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        // $fecha = now();
        // $producto->update($request->all());
        // if($request->hasFile('imagen')){
        //     $producto['imagen'] = $request->file('imagen')->store('public/imagenes');
        // }
        // $producto['updated_at'] = $fecha;
        // $url = Storage::url($producto['imagen']);
        // $producto['imagen'] = $url;
        // Producto::edit($producto);
        $producto->update($request->all());
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
    }
}
