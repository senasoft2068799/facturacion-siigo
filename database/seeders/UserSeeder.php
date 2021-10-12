<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jp = new User();
        $jp->id = "1005716784";
        $jp->tipo_documento = "CC";
        $jp->nombre = "Juan";
        $jp->apellido = "Machado";
        $jp->email = "juanpismachado@gmail.com";
        $jp->telefono = "3227669359";
        $jp->password = Hash::make("12345678");
        $jp->estado = 1;
        $jp->role_id = 1;
        $jp->save();
    }
}
