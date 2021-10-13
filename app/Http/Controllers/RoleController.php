<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index()
    {
        //return RoleResource::collection(Role::latest()->get());
        return RoleResource::collection(Role::paginate(1));
    }

    public function store(Request $request)
    {
        $request->validate([
            "nombre" => "required|min:2|max:20"
        ]);
        Role::create($request->all());
    }

    public function show(Role $role)
    {
        return $role;
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            "nombre" => "required|min:2|max:20"
        ]);
        $role->update($request->all());
    }

    public function destroy(Role $role)
    {
        $role->estado = !$role->estado;
        $role->save();
    }
}
