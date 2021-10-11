<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BodegaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "nombre" => $this->nombre,
            "direccion" => $this->direccion,
            "estado_bodega" => $this->estado_bodega,
            "sucursal" => $this->sucursale,
            "productos" => $this->productos,
            "created_at" => $this->created_at->diffForHumans(),
            "updated_at" => $this->updated_at->diffForHumans(),
        ];
    }
}
