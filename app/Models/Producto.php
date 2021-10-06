<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['imagen'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function bodegas()
    {
        return $this->belongsToMany(Bodega::class, "stocks");
    }
}
