<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }

    public function sucursale()
    {
        return $this->belongsTo(Sucursale::class);
    }

    public function detalle_movimientos()
    {
        return $this->hasMany(DetalleMovimiento::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
