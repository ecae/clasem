<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearUsoMaquinariaRequest extends FormRequest
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
            "detalle"=>"required|min:3",
            "hora_Inicial"=>"required|date_format:H:i",
            "hora_Final"=>"required|date_format:H:i",
            "inicial_horometro"=>"required|integer|min:3",
            "final_horometro"=>"required|integer|min:3",
        ];
    }
}
