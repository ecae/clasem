<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
Use Hashids;

class CrearPersonaRequest extends FormRequest
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
                $userID_rule = ['exists:users,id', Rule::unique('personas')->ignore($desencriptando)];
                $emai_rule = ['min:6', 'email', Rule::unique('personas')->ignore($desencriptando)];
            }
        }
        else
        {
            // Create operation. There is no id yet.
            $userID_rule ='required|exists:users,id|unique:personas';
            $emai_rule ='required|email|unique:personas';
        }
        return [
            'nombre'=>'required|min:3',
            'apellidoPat'=>'required|min:3',
            'apellidoMat'=>'required|min:3',
            'area_id'=>'required|exists:areas,id',
            'user_id'=>$userID_rule,
            'email' => $emai_rule,
            'estado' => 'required|boolean',
        ];
    }
    public function messages()
    {
        return [
            'user_id.unique' => 'El Usuario ya esta en uso.',
            'email.unique'  => 'El Email ya ha sido registrado.',
        ];
    }
}
