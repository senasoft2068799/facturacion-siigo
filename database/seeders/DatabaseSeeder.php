<?php

namespace Database\Seeders;

use App\Models\Bodega;
use App\Models\Ciudade;
use App\Models\DetalleMovimiento;
use App\Models\Movimiento;
use App\Models\Producto;
use App\Models\Sucursale;
use App\Models\Categoria;
use App\Models\User;
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
        // Role::factory(10)->create();
        $this->call(RoleSeeder::class);
        User::factory(5)->create();
        $this->call(UserSeeder::class);
        Ciudade::factory(50)->create();
        $this->call(DocumentoSeeder::class);
        Sucursale::factory(20)->create();
        Bodega::factory(15)->create();
        Categoria::factory(10)->create();
        Producto::factory(30)->create();
        Movimiento::factory(20)->create();
        DetalleMovimiento::factory(150)->create();
    }
}
