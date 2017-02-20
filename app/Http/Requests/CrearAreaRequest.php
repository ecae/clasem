<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class CrearAreaRequest extends FormRequest
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
            $area_rule =['min:6',Rule::unique('areas')->ignore($this->segment(3))];

        }
        else
        {
            // Create operation. There is no id yet.
            $area_rule = 'required|min:4|unique:areas';

        }
        return [

            'area' =>$area_rule,


        ];


    }
    public function messages()
    {
        return [
            'area.unique' => 'Área ya registrada',
        ];
    }
}
