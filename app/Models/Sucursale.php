<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursale extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ciudade()
    {
        return $this->belongsTo(Ciudade::class);
    }

    public function bodegas()
    {
        return $this->hasMany(Bodega::class);
    }
}
