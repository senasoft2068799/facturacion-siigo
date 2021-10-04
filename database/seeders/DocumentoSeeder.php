<?php

namespace Database\Seeders;

use App\Models\Documento;
use Illuminate\Database\Seeder;

class DocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $documento = new Documento();
        $documento->nombre = "Facturacion";
        $documento->save();

        $documento2 = new Documento();
        $documento2->nombre = "Compra";
        $documento2->save();

        $documento3 = new Documento();
        $documento3->nombre = "Registro de bodega";
        $documento3->save();
    }
}
