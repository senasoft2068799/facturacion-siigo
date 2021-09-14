<?php

namespace Database\Seeders;

use App\Models\Bodega;
use App\Models\Ciudade;
use App\Models\Documento;
use App\Models\Sucursale;
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
        Bodega::factory(15)->create();
    }
}
