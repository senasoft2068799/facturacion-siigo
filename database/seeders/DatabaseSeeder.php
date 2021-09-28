<?php

namespace Database\Seeders;

use App\Models\Bodega;
use App\Models\Categoria;
use App\Models\Ciudade;
use App\Models\DetalleMovimiento;
use App\Models\Documento;
use App\Models\Movimiento;
use App\Models\Producto;
use App\Models\Role;
use App\Models\Sucursale;
use App\Models\Categoria;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        Role::factory(10)->create();
        Ciudade::factory(50)->create();
        Documento::factory(15)->create();
        Sucursale::factory(20)->create();
<<<<<<< HEAD
        Categoria::factory(10)->create();
=======
        Bodega::factory(15)->create();
        Categoria::factory(10)->create();
        Producto::factory(30)->create();
        Movimiento::factory(20)->create();
        DetalleMovimiento::factory(150)->create();
>>>>>>> f5d4082fc47dfb0497ef060bc936d12c680f72e2
    }
}
