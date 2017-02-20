<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEquiposRequest extends FormRequest
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

            $file_rule ='mimes:jpeg,jpg,png,gif';

        }

        return [
            "fabricante"=>"required|min:3",
            "marca"=>"required|min:3",
            "modelo"=>"required|min:3",
            "serie"=>"required|min:3",
            //"fechacompra"=>"required|date_format:d/m/Y",
            "fechacompra"=>"required|date",
            'path' => $file_rule,
            "estado"=>"required|boolean",

        ];
    }
}
