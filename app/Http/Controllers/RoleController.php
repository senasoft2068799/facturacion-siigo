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

    public function destroy(Role $role)
    {
        $role->delete();
    }
}
