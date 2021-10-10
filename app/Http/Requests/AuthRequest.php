<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AuthRequest extends FormRequest
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
            "id" => ["required", "unique:users", "min:6", "max:20"],
            "tipo_documento" => ["required", Rule::in(
                [
                    "NIT",
                    "CC",
                    "TI",
                    "TP",
                    "RC",
                    "CE",
                    "DNI",
                ]
            ),],
            "nombre" => ["required", "max:45"],
            "apellido" => ["required", "max:45"],
            "email" => ["required", "email", "unique:users", "min:6", "max:40"],
            "telefono" => ["required", "min:7", "max:20"],
            "password" => ["required", "min:6", "max:20", "confirmed"],
            "password_confirmation" => ["required",]
        ];
    }

    public function attributes()
    {
        return [
            "id" => "número de documento"
        ];
    }
}
