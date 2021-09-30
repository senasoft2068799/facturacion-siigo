<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SucursaleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "nombre" => $this->nombre,
            "direccion" => $this->direccion,
            "telefono" => $this->telefono,
            "ciudad" => $this->ciudade,
            "created_at" => $this->created_at->diffForHumans(),
            "updated_at" => $this->updated_at->diffForHumans(),
        ];
    }
}
