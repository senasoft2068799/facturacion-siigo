<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FacturaResource extends JsonResource
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
            "descripcion" => $this->descripcion,
            "valor_total" => $this->valor_total,
            "documento" => $this->documento,
            "sucursal" => $this->sucursale,
            "tercero" => $this->id,
            "detalle_facturas" => $this->detalle_movimientos,
            "estado" => $this->estado,
            "created_at" => $this->created_at->diffForHumans(),
            "updated_at" => $this->updated_at->diffForHumans(),
        ];
    }
}
