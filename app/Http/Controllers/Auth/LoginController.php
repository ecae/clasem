<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Redirect;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function logout(){
        Auth::logout();
        return Redirect::to('/');
    }
    public function login(Request $request){
        $name=$request->input('username');
        $valor='';
        $estados=DB::table('users')->select('estado')->where('username',$name)->get();
        foreach($estados as $esta){
            $valor=$esta->estado;
        }
        if($valor==1){
            if(Auth::attempt(['username'=>$request['username'],'password'=>$request['password']]))
            {
                if(Auth::user()->tipousuario_id==1)
                {
                    return Redirect::to('admin/Principal');
                }
                elseif(Auth::user()->tipousuario_id==2)
                {
                    return Redirect::to('operario/Home');
                }

            }
            else{
                Session::flash('message-error','Credenciales Incorrectas!');
                return Redirect::to('/');
            }


        }
        else{
            Session::flash('message-error','Su cuenta esta Suspendida!');
            return Redirect::to('/');
        }
    }
}
