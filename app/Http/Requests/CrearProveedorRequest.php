<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
Use Hashids;

class CrearProveedorRequest extends FormRequest
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
                $ruc_rule = ['required', 'size:11', Rule::unique('proveedors')->ignore($desencriptando)];
            }

        }
        else
        {
            // Create operation. There is no id yet.
            $ruc_rule ='required|size:11|unique:proveedors';
        }
        return [
            'ruc' => $ruc_rule,
            'razonsocial'=>'required|min:4',
            'direccion'=>'required|min:6',
            'nombrecontacto'=>'required|min:4',
            'email'=>'required|email',
            'celular'=>'required|min:6',
            'descripcion'=>'required|min:6',
            'estado' => 'required|boolean',
        ];
    }
    public function messages()
    {
        return [
            'ruc.unique' => 'El RUC ya esta registrado',
        ];
    }

}
