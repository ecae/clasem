<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearAltaMantenimientoRequest extends FormRequest
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
            "mantenimiento_id"=>"required|exists:mantenimientos,id",
            "proveedor_id"=>"exists:proveedors,id",
            "ordentrabajo_id"=>"required|exists:orden_trabajos,id",
            "costo"=>"required|numeric|min:1",
            "descripcion"=>"required|min:6",
            "Nfecha_inicial"=>"date",
            "Nhorometro"=>"numeric|min:0",
            'path' => 'mimes:jpeg,jpg,png,pdf|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'path.mimes' => 'El archivo tiene que ser una Foto o un PDF',
            'path.max' => 'El archivo tiene que tener máx. 2MB',
        ];
    }
}
