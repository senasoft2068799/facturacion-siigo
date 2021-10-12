<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "cantidad" => $this->cantidad,
            "bodega" => $this->bodega,
            "producto" => $this->producto,
        ];
    } 
}
