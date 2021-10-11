<?php

namespace App\Http\Resources;

use App\Models\Categoria;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            "id" => $this->id, 
            "nombre" => $this->nombre,
            "precio_unitario" => $this->precio_unitario,
            "imagen" => $this->imagen,
            "categoria" => $this->categoria,
            "estado" => $this->estado,
            "created_at" => $this->created_at->diffForHumans(),
            "updated_at" => $this->updated_at->diffForHumans()
        ];
    }
}
