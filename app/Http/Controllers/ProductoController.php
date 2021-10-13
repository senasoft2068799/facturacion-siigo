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
        $request->validate([
            'nombre' => 'required|min:2|max:45',
            'precio_unitario' => 'required|numeric|min:1000|max:9999999999',
            "categoria_id" => "required|exists:categorias,id",
            'imagen' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

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
        return new ProductoResource($producto);
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
        $request->validate([
            'nombre' => 'required|min:2|max:45',
            'precio_unitario' => 'required|numeric|min:1000|max:9999999999',
            "categoria_id" => "required|exists:categorias,id",
        ]);
        $producto = Producto::find($id);
        $producto->nombre = $request->nombre;
        $producto->precio_unitario = $request->precio_unitario;
        $producto->categoria_id = $request->categoria_id;
        if ($request->hasFile('imagen')) {
            $datosImagen = $request->file('imagen')->store('public/imagenes');
            $url = Storage::url($datosImagen);
            $producto->imagen = $url;
        }
        $producto->save();
    }

    public function destroy(Producto $producto)
    {
        $producto->estado = !$producto->estado;
        $producto->save();
    }

    public function downloadTemplate()
    {
        $file = public_path() . "/files/template.xlsx";
        info($file);
        $headers = [
            'Content-Type'              => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Length'            => filesize($file),
            'Cache-Control'             => 'must-revalidate',
            'Content-Transfer-Encoding' => 'binary',
            'Content-Disposition'       => 'attachment; filename="template.xlsx"'
        ];
        return response()->download($file, 'filename.xlsx', $headers);
    }

    public function importExcel(Request $request)
    {
        //Comento todo esto para que muestre un error si es que lo hay
        // try { 
        //     set_time_limit(0);
        //     DB::beginTransaction();
        //     Excel::import(new ProductoImport(), $request->file('file'));
        //     DB::commit();
        // } catch (\Exception $exception) {
        //     DB::rollBack();
        //     info($exception);
        // }
        set_time_limit(0);
        DB::beginTransaction();
        Excel::import(new ProductoImport(), $request->file('file'));
        DB::commit();
    }

    public function traerProductos(Request $request)
    {
        $filtro = $request->buscador;
        return ProductoResource::collection(Producto::where("nombre", 'LIKE', '%' . $filtro . '%')->get());
    }
}
