<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index()
    {
        return array_reverse(Role::all()->toArray());
    }

    public function store(Request $request)
    {
        Role::create($request->all());
    }

    public function show(Role $role)
    {
        return $role;
    }

    public function update(Request $request, Role $role)
    {
        $role->update($request->all());
    }

    public function activar(Role $role)
    {
        $role->estado_role = 1;
        $role->save();
    }

    public function destroy(Role $role)
    {
        $role->estado_role = 0;
        $role->save();
    }
}
