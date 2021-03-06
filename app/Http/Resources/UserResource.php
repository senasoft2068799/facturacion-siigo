<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "tipo_documento" => $this->tipo_documento,
            "nombre" => $this->nombre,
            "apellido" => $this->apellido,
            "email" => $this->email,
            "telefono" => $this->telefono,
            "estado" => $this->estado,
            "rol" => $this->role,
            "created_at" => $this->created_at->diffForHumans(),
            "updated_at" => $this->updated_at->diffForHumans(),
        ];
    }
}
