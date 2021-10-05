<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductoResource;
use App\Models\Producto;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\DB;
use App\Imports\ProductoImport;

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
    public function update(Request $request, $id)//Si esta viendo todo este desorden, ignorelo xd casi logro editar la imagen
    {
        info($request);
        $producto = Producto::find($id);
        $producto->nombre = $request->nombre;
        $producto->precio_unitario = $request->precio_unitario;
        $producto->categoria_id = $request->categoria_id;
        info($producto);
        $producto->save();

        // $producto->update($request->all());
        // $fecha = now();
        // info($id);
        // $producto->imagen = $request->imagen;
        // info($request);
        
        // $producto->update($request->all());
        // $producto = $request->all();
        // info($producto);

        // // $ig = $request->file('imagen');
        // // $ig = $request->hasFile('imagen');

        // if($request->hasFile('imagen')){
        //     // foreach($request->file('imagen') as $image)
        //     // {
        //     //     $imagen = $image->getClientOriginalName();
        //     //     $image->move(public_path().'/imagenes/', $imagen);
        //     // }
        //     $producto['imagen'] = $request->file('imagen')->store('public/imagenes');
        // }
        // else {
        //     info('No toma la imagen');
        // }
        // $producto['updated_at'] = $fecha;
        // $url = Storage::url($producto['imagen']);
        // $producto['imagen'] = $url;
        // info($producto);
        // Producto::edit($producto);
        
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
    }

    public function importExcel(Request $request)
    {
        try {
            set_time_limit(0);
            DB::beginTransaction();
            Excel::import(new ProductoImport(), $request->file('file'));
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            info($exception);
        }
    }
}
