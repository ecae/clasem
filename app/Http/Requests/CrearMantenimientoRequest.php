<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearMantenimientoRequest extends FormRequest
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
            'fichatecnica_id'=>'required|exists:ficha_tecnicas,id',
            'detalle'=>'required|min:3',
            'fecha_inicial'=>'date',
            'dias'=>'integer|min:1',
            'horometro'=>'integer|min:3',
            'estado' => 'required|boolean',
        ];
    }
}
