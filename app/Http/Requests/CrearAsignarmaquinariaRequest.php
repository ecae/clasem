<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
Use Hashids;

class CrearAsignarmaquinariaRequest extends FormRequest
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
            // Update operation, exclude the record with id from the validation:
            $desencriptando = Hashids::decode($this->segment(3));
            $contar=count($desencriptando);
            if($contar==0){
                return view('errors.500');
            }else {
                $desencriptando = Hashids::decode($this->segment(3))[0];
                $fichaID_rule = ['required', 'exists:ficha_tecnicas,id', Rule::unique('asignar_maquinarias')->ignore($desencriptando)];
                $personaID_rule = ['required', 'exists:personas,id', Rule::unique('asignar_maquinarias')->ignore($desencriptando)];
            }

        }
        else
        {
            // Create operation. There is no id yet.
            $fichaID_rule ='required|exists:ficha_tecnicas,id|unique:asignar_maquinarias';
            $personaID_rule ='required|exists:personas,id|unique:asignar_maquinarias';
        }
        return [
            'descripcion'=>'required|min:5',
            'fichatecnica_id'=>$fichaID_rule,
            'persona_id'=>$personaID_rule,
            'estado' => 'required|boolean',
        ];
    }
    public function messages()
    {
        return [
            'fichatecnica_id.unique' => 'La Maquinaria ya esta asignada.',
            'persona_id.unique' => 'El Encargado ya tiene asignada una Maquinaria.',
        ];
    }
}
