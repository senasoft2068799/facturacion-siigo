<?php

namespace App\Http\Resources;

use App\Models\Role;
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
        return[
            "id" => $this->id,
            "nombre" => $this->nombre,
            "apellido" => $this->apellido,
            "email" => $this->email,
            "telefono" => $this->telefono,
            "role" => $this->role
        ];
    }
}
