<?php

namespace Database\Seeders;

use App\Models\Ciudade;
use App\Models\Documento;
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
        // \App\Models\User::factory(10)->create();
        Ciudade::factory(50)->create();
        Documento::factory(15)->create();
        Sucursale::factory(20)->create();
        Categoria::factory(10)->create();
    }
}
