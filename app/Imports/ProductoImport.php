<?php

namespace App\Imports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductoImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Producto([
            'nombre' => $row["nombre"],
            'precio_unitario' => $row["precio"],
            'categoria_id' => $row["categoria"]
        ]);
    }

    // public function headingRow(): int
    // {
    //     return 0;
    // }
}
