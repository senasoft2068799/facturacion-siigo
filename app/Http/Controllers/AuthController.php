<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Mail\registroUsuarioMailable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // $request->validate([
        //     "id" => ["required", "unique:users", "min:6", "max:20"],
        //     "tipo_documento" => ["required", Rule::in(
        //         [
        //             "NIT",
        //             "CC",
        //             "TI",
        //             "TP",
        //             "RC",
        //             "CE",
        //             "DNI",
        //         ]
        //     ),],
        //     "nombre" => ["required", "max:45"],
        //     "apellido" => ["required", "max:45"],
        //     "email" => ["required", "email", "unique:users", "min:6", "max:40"],
        //     "telefono" => ["required", "min:7", "max:20"],
        //     "password" => ["required", "min:6", "max:20", "confirmed"],
        //     "password_confirmation" => ["required"],
        //     "role_id" => ["required|exists:roles,id"]
        // ]);

        $user = User::create([
            "id" => $request->id,
            "tipo_documento" => $request->tipo_documento,
            "nombre" => $request->nombre,
            "apellido" => $request->apellido,
            "email" => $request->email,
            "telefono" => $request->telefono,
            "password" => Hash::make($request->password),
            "role_id" => 1
        ]);

        // $admins = User::where("role_id", 1)->get();
        // Notification::send($admins, new UsuarioRegistrado($user));
        $mail = new registroUsuarioMailable($request->all());
        Mail::to($request->email)->send($mail);

        return response()->json(["msg" => "Usuario registrado correctamente."]);
    }

    // public function mailStyle()
    // {
    //     return view("")
    // }

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

        $token = $user->createToken($request->device_name)->plainTextToken;
        return $token;
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(["msg" => "Sesi??n finalizada correctamente."]);
    }

    public function unreadNotifications()
    {
        // $unreadNotifications = User::find("1005716784");
        $user = User::find("1005716784");
        $unreadNotifications = $user->unreadNotifications;
        // info($unreadNotifications);
        return response()->json($unreadNotifications);
    }

    public function markAsRead()
    {
        $user = User::find("1005716784");
        $user->notifications->markAsRead();
        return response()->json("success");
    }
}
