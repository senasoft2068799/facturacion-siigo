<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return array_reverse(User::all()->toArray());
    }

    public function store(Request $request)
    {
        User::create($request->all());
    }

    public function show(User $user){
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
    }

    public function destroy(User $user)
    {
        $user->delete();
    }
}
