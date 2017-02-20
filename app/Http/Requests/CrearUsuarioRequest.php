<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
Use Hashids;
class CrearUsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /**
     * Método utilizado en el formrequest
     * @var string
     */
    protected $metodo;

    /**
     * ID del usuario autenticado
     * @var integer
     */
    protected $user_id;


    public function __construct(Request $request)
    {
        $this->user_id = $request->user()->id;
        $this->metodo  = $request->method();
    }
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * |exists:tipousuarios,id
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
                //$username_rule =['min:6',Rule::unique('users')->ignore($this->segment(3))];
                $username_rule = ['min:6', Rule::unique('users')->ignore($desencriptando)];
                $password_ruler = 'nullable|min:6';
            }

        }
        else
        {
            // Create operation. There is no id yet.
            $username_rule = 'required|min:6|unique:users';
            $password_ruler='required|min:6';
        }
        return [
            'tipousuario_id'=>'required|exists:tipousuarios,id',
            'username' => $username_rule,
            'password' => $password_ruler,
            'estado' => 'required|boolean',
        ];


    }
    public function messages()
    {
        return [
            'username.unique'  => 'Usuario ya registrado.',
            'password.min'=>'La contraseña debe de tener un mínimo 6 caracteres',

        ];
    }
}
