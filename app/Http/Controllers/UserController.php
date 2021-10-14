<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // return UserResource::collection(User::paginate(3));
        return UserResource::collection(User::latest()->get());
    }

    public function store(Request $request)
    {
        User::create($request->all());
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
    }

    public function destroy(User $user)
    {
        $user->estado = !$user->estado;
        $user->save();
    }
}
