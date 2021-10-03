<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            "id" => ["required", "unique:users", "min:6", "max:20"],
            "tipo_documento" => ["required", Rule::in(
                [
                    "NIT",
                    "CC",
                    "TI",
                    "TP",
                    "RC",
                    "CE",
                    "DNI",
                ]
            ),],
            "nombre" => ["required", "max:45"],
            "apellido" => ["required", "max:45"],
            "email" => ["required", "email", "unique:users", "min:6", "max:40"],
            "telefono" => ["required", "min:7", "max:20"],
            "password" => ["required", "min:6", "max:20", "confirmed"],
            "password_confirmation" => ["required"],
            "role_id" => ["required"]
        ]);

        User::create([
            "id" => $request->id,
            "tipo_documento" => $request->tipo_documento,
            "nombre" => $request->nombre,
            "apellido" => $request->apellido,
            "email" => $request->email,
            "telefono" => $request->telefono,
            "password" => Hash::make($request->password),
            "role_id" => $request->role_id
        ]);

        return response()->json(["msg" => "Usuario registrado correctamente."]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Los datos de acceso son incorrectos.'],
            ]);
        }

        return $user->createToken($request->device_name)->plainTextToken;
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(["msg" => "Sesión finalizada correctamente."]);
    }
}
