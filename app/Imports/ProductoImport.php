<?php

namespace App\Imports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductoImport implements ToModel
{
    public function model(array $row)
    {
        return new Producto([
            'nombre' => $row[0],
            'precio_unitario' => $row[1],
            'categoria_id' => $row[2]
        ]);
    }
}
