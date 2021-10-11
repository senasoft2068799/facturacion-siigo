<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->nombre = "Administrador";
        $role->estado_role = 1;
        $role->save();

        $role2 = new Role();
        $role2->nombre = "Vendedor";
        $role2->estado_role = 1;
        $role2->save();

        $role3 = new Role();
        $role3->nombre = "Cliente";
        $role3->estado_role = 1;
        $role3->save();
    }
}
