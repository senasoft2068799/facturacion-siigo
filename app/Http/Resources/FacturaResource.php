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
            "user" => $this->user,
            "detalle_movimientos" => DetalleMovimientoResource::collection($this->detalle_movimientos()->get()),
            "estado_factura" => $this->estado_factura,
            "created_at" => $this->created_at->diffForHumans(),
            "updated_at" => $this->updated_at->diffForHumans(),
        ];
    }
}
