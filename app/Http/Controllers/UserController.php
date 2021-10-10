<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::latest()->get());
    }

    public function store(Request $request)
    {
        User::create($request->all());
    }

    public function show(User $user)
    {
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
    }

    public function destroy(User $user)
    {
        $user->estado_usuario = 0;
        $user->save();
    }

    public function activar(User $user)
    {
        $user->estado_usuario = 1;
        $user->save();
    }
}
