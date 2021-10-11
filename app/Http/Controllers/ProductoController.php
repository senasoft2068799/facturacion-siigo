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

    public function store(Request $request)
    {
        $fecha = now();
        $datosProducto = $request->all();
        if ($request->hasFile('imagen')) {
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        info($request);
        $producto = Producto::find($id);
        $producto->nombre = $request->nombre;
        $producto->precio_unitario = $request->precio_unitario;
        $producto->categoria_id = $request->categoria_id;
        if ($request->hasFile('imagen')) {
            $datosImagen = $request->file('imagen')->store('public/imagenes');
            $url = Storage::url($datosImagen);
            $producto->imagen = $url;
        }
        info($producto);
        $producto->save();
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
    }

    public function downloadTemplate()
    {
        $file = public_path() . "/files/template.csv";
        info($file);
        $headers = [
            'Content-Type' => "data:text/csv;charset=utf-8",
        ];
        return response()->download($file, 'filename.csv', $headers);
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

    public function traerProductos(Request $request)
    {
        $filtro = $request->buscador;
        return ProductoResource::collection(Producto::where("nombre", 'LIKE', '%' . $filtro . '%')->get());
    }
}
