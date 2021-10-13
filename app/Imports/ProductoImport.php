<?php

namespace App\Imports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductoImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Producto([
            'nombre' => $row["nombre"],
            'precio_unitario' => $row["precio"],
            'categoria_id' => $row["categoria"]
        ]);
    }
}
