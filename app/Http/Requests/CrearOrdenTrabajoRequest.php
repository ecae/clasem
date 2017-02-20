<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearOrdenTrabajoRequest extends FormRequest
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
            'maquinaria_id'=>'required|exists:ficha_tecnicas,id',
            'kilometraje'=>'numeric|min:0',
            'horometro'=>'numeric|min:0',
            'loca_averia'=>'required',
            'tipo_mantenimiento'=>'required',
            'descripcion_trabajo'=>'required|min:6'
        ];
    }
}
