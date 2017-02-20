<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearEquiposRequest extends FormRequest
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
        if ($this->method() == 'PUT')
        {

            $file_rule ="mimes:jpeg,jpg,png,gif";


        }
        else
        {

            $file_rule ='mimes:jpeg,jpg,png,gif|required';

        }

        return [
            "fabricante"=>"required|min:3",
            "marca"=>"required|min:3",
            "modelo"=>"required|min:3",
            "serie"=>"required|min:3",
            "fechacompra"=>"required|date",
            'path' => $file_rule,
            "estado"=>"required|boolean",

        ];
    }
    public function messages()
    {
        return [
            'path.mimes' => 'El Archivo no es una Fotografía',
        ];
    }
}
