<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrearUsuarioRequest;
use App\TipoUsuario;
use App\User;
use Illuminate\Http\Request;
Use DB;
use Yajra\Datatables\Facades\Datatables;
Use Hashids;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $tipousuario=TipoUsuario::select('id','tipousuario')->get();
        return view('usuarios.index',compact('tipousuario'));
    }
   public function getUser(){
        $users=User::select(['users.id','users.username','tipousuario'])
            ->join('tipousuarios','users.tipousuario_id','=','tipousuarios.id')
            ->get();
        return Datatables::of($users)->addColumn('action', function ($user) {
            $encriptado=Hashids::encode($user->id);
            return "<div class='btn-group'>
            <button value=".$encriptado." OnClick='Ver(this);' data-toggle='modal' data-target='#myModal5'  class='btn btn-info' ><i class='md  md-remove-red-eye'></i></button>
            <button value=".$encriptado." OnClick='Mostrar(this);'  data-toggle='modal' data-target='#myModal2' class='btn btn-primary '><i class=' ion-edit'></i></button>
            <button value=".$encriptado." OnClick='Eliminar(this);' data-toggle='modal' data-target='#myModal9' class='btn btn-danger '><i class=' ion-trash-a'></i></button>
             <div>";
        })->editColumn('tipousuario', function($users) {
            if($users->tipousuario=='Administrador'){
                return "<span class='label label-danger'>". $users->tipousuario . "</span>";
            } else{ return "<span class='label label-success'>" . $users->tipousuario ."</span>";}

            })
            ->editColumn('id', function($users) {
                $conca='US'.str_pad($users->id, 4, "0", STR_PAD_LEFT);
                return $conca;
            })
            ->make(true);


    }


    public function ComprobarUser(Request $request)
    {
        $user=$request->all();
        $valor='';
        $resultado=DB::table('users')->select('username')->where('username',$user)->get();
        foreach($resultado as $resul){
            $valor=$resul->username;
        }
        $arr['success']='';
        if ($valor=='') {
            $arr['success'] = true;

        } else {

            $arr['success'] = false;

        }
        return json_encode($resultado);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CrearUsuarioRequest $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearUsuarioRequest $request)
    {
        $user=new User($request->all());
        $user->password= bcrypt($request->password);
        $user->save();
        return response()->json(["mensaje"=>$request->input('username')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $desencriptando = Hashids::decode($id);
        $contar=count($desencriptando);
        if($contar==0){
            return view('errors.500');
        }else {
            $desencriptando = Hashids::decode($id)[0];
            $user = User::find($desencriptando);
            return response()->json($user);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CrearUsuarioRequest $request, $id)
    {
        $desencriptando = Hashids::decode($id);
        $contar=count($desencriptando);
        if($contar==0){
            return view('errors.500');
        }else {
            $desencriptando = Hashids::decode($id)[0];
            $contraseña = $request->input('password');
            $tipousuario = $request->input('tipousuario_id');
            $username = $request->input('username');
            $estado = $request->input('estado');
            if ($contraseña == "") {
                $user = User::find($desencriptando);
                $user->tipousuario_id = $tipousuario;
                $user->username = $username;
                $user->estado = $estado;
                $user->save();
            } else {
                $user = User::find($desencriptando);
                $user->tipousuario_id = $tipousuario;
                $user->username = $username;
                $user->password = bcrypt($contraseña);
                $user->estado = $estado;
                $user->save();
            }
            return response()->json(["mensaje" => $request->input('username')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $desencriptando = Hashids::decode($id);
        $contar=count($desencriptando);
        if($contar==0){
            return view('errors.500');
        }else {
            $desencriptando = Hashids::decode($id)[0];
            User::destroy($desencriptando);
            return response()->json(["mensaje" => "exitosamente"]);
        }

    }
}
