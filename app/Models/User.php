<?php

namespace App\Models;

use App\Notifications\UsuarioRegistrado;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        "id",
        "tipo_documento",
        "nombre",
        "apellido",
        "email",
        "telefono",
        "password",
        "estado_usuario",
        "role_id"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // public static function boot()
    // {
    //     parent::boot();


    //     static::created(function ($model) {
    //         // $user = User::first();
    //         // $user->notify(new UsuarioRegistrado());

    //         // $admins = User::all()->filter(function (User $user) {
    //         //     return $user->hasRole("Administrador");
    //         // });
    //         $admins = User::where("role_id", 1)->get();
    //         // $user = User::find("1005716784");
    //         // $user->notify(new UsuarioRegistrado());

    //         Notification::send($admins, new UsuarioRegistrado($model));
    //     });
    // }
}
