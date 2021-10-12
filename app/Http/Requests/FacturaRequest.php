<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FacturaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "descripcion" => "max:255",
            "valor_total" => "required|numeric",
            "documento_id" => "required|exists:documentos,id",
            "sucursale_id" => "required|exists:sucursales,id",
            "user_id" => "required|exists:users,id",
            "estado" => ["required", Rule::in([0, 1])],
            "items" => "required|array|min:2",
            "items.*.cantidad" => "required|numeric|min:1|max:255",
            "items.*.producto.id" => "required|exists:productos,id",
            "items.*.bodega.id" => "required|exists:bodegas,id"
        ];
    }

    public function attributes()
    {
        return [
            "user_id" => "cliente",
            "items" => "items de factura",
            "items.*.cantidad" => "cantidad",
            "items.*.producto.id" => "producto",
            "items.*.bodega.id" => "bodega",
        ];
    }
}
