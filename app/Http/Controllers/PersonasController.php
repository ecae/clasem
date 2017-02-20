<?php

namespace App\Http\Controllers;

use App\Area;
use App\Http\Requests\CrearPersonaRequest;
use App\Persona;
use App\User;
use Illuminate\Http\Request;
Use DB;
Use Hashids;
use Yajra\Datatables\Facades\Datatables;

class PersonasController extends Controller
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
        $usuarios=User::select('id','username')->get();
        $areas=Area::select('id','area')->get();

        return view('personal.index',compact('usuarios','areas'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPersonal(){
        $personas=Persona::select(DB::raw('personas.id,CONCAT(personas.nombre," ",personas.apellidoPat," ",personas.apellidoMat)AS ncompletos,users.username,areas.area'))
            ->join('users','users.id','=','personas.user_id')
            ->join('areas','areas.id','=','personas.area_id')
            ->get();
        return Datatables::of($personas)->addColumn('action', function ($persona) {
            $encriptado=Hashids::encode($persona->id);
            return "<div class='btn-group'>
            <button value=".$encriptado." OnClick='Ver(this);' data-toggle='modal' data-target='#myModal5'  class='btn btn-info' ><i class='md  md-remove-red-eye'></i></button>
            <button value=".$encriptado." OnClick='Mostrar(this);'  data-toggle='modal' data-target='#myModal2' class='btn btn-primary '><i class=' ion-edit'></i></button>
            <button value=".$encriptado." OnClick='Eliminar(this);' data-toggle='modal' data-target='#myModal9' class='btn btn-danger '><i class=' ion-trash-a'></i></button>
             <div>";
        })
            ->editColumn('id', function($personas) {
                $conca='PE'.str_pad($personas->id, 4, "0", STR_PAD_LEFT);
                return $conca;
            })
            ->make(true);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearPersonaRequest $request)
    {
        $persona=new Persona($request->all());
        $persona->save();
        $ncompletos=$request->input('name').' '.$request->input('apellidoPat').' '.$request->input('apellidoMat');
        return response()->json(["mensaje"=>$ncompletos]);
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
            $persona = Persona::find($desencriptando);
            return response()->json($persona);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CrearPersonaRequest $request, $id)
    {
        $desencriptando = Hashids::decode($id);
        $contar=count($desencriptando);
        if($contar==0){
            return view('errors.500');
        }else {
            $desencriptando = Hashids::decode($id)[0];
            $persona = Persona::find($desencriptando);
            $persona->fill($request->all());
            $persona->save();
            $ncompletos = $request->input('name') . ' ' . $request->input('apellidoPat') . ' ' . $request->input('apellidoMat');
            return response()->json(["mensaje" => $ncompletos]);
        }
    }

    public function edit2($id)
    {
        $desencriptando = Hashids::decode($id);
        $contar=count($desencriptando);
        if($contar==0){
            return view('errors.500');
        }else {
            $desencriptando = Hashids::decode($id)[0];
            $persona = Persona::select(DB::raw('personas.id,personas.nombre,personas.apellidoPat,personas.apellidoMat,users.username,areas.area,personas.email,personas.estado'))
                ->join('users', 'users.id', '=', 'personas.user_id')
                ->join('areas', 'areas.id', '=', 'personas.area_id')
                ->where('personas.id', '=', $desencriptando)
                ->get();

            return response()->json($persona);
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
            Persona::destroy($desencriptando);
            return response()->json(["mensaje" => "exitosamente"]);
        }
    }
}
