<?php

namespace App\Http\Controllers;

use App\AsignarMaquinaria;
use App\FichaTecnica;
use App\Http\Requests\CrearAsignarmaquinariaRequest;
use App\Persona;
use Illuminate\Http\Request;
Use DB;
use Yajra\Datatables\Facades\Datatables;
Use Hashids;

class AsignarMaquinariasController extends Controller
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
        $equipos=FichaTecnica::select('id','descripcion')->get();
        $personas=Persona::select('id','nombre')->get();
        return view('asignarmaquinaria.index',compact('equipos','personas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAsignacion(){
        $asignaciones=AsignarMaquinaria::select(DB::raw('asignar_maquinarias.id,CONCAT(personas.nombre," ",personas.apellidoPat," ",personas.apellidoMat)AS ncompletos,(ficha_tecnicas.descripcion) AS equipo,asignar_maquinarias.descripcion'))
            ->join('ficha_tecnicas','ficha_tecnicas.id','=','asignar_maquinarias.fichatecnica_id')
            ->join('personas','personas.id','=','asignar_maquinarias.persona_id')
            ->get();

        return Datatables::of($asignaciones)->addColumn('action', function ($asignacion) {
            $encriptando = Hashids::encode($asignacion->id);
            return "<div class='btn-group'>
            <button value=".$encriptando." OnClick='Ver(this);' data-toggle='modal' data-target='#myModal5'  class='btn btn-info' ><i class='md  md-remove-red-eye'></i></button>
            <button value=".$encriptando." OnClick='Mostrar(this);'  data-toggle='modal' data-target='#myModal2' class='btn btn-primary '><i class=' ion-edit'></i></button>
            <button value=".$encriptando." OnClick='Eliminar(this);' data-toggle='modal' data-target='#myModal9' class='btn btn-danger '><i class=' ion-trash-a'></i></button>
             <div>";
        })
            ->editColumn('id', function($asignaciones) {
                $conca='AS'.str_pad($asignaciones->id, 4, "0", STR_PAD_LEFT);
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
    public function store(CrearAsignarmaquinariaRequest $request)
    {
        $asignacion=new AsignarMaquinaria($request->all());
        $asignacion->save();
        return response()->json(["mensaje"=>$request->input('descripcion')]);
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
            $asignacion = AsignarMaquinaria::find($desencriptando);
            return response()->json($asignacion);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CrearAsignarmaquinariaRequest $request, $id)
    {
        $desencriptando = Hashids::decode($id);
        $contar=count($desencriptando);
        if($contar==0){
            return view('errors.500');
        }else {
            $desencriptando = Hashids::decode($id)[0];
            $asignacion = AsignarMaquinaria::find($desencriptando);
            $asignacion->fill($request->all());
            $asignacion->save();
            return response()->json(["mensaje" => $request->input('descripcion')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit2($id)
    {
        $desencriptando = Hashids::decode($id);
        $contar=count($desencriptando);
        if($contar==0){
            return view('errors.500');
        }else {
            $desencriptando = Hashids::decode($id)[0];
            $asignacion = AsignarMaquinaria::select(DB::raw('asignar_maquinarias.id,CONCAT(personas.nombre," ",personas.apellidoPat," ",personas.apellidoMat)AS ncompletos,(ficha_tecnicas.descripcion) AS equipo,ficha_tecnicas.marca,ficha_tecnicas.modelo,asignar_maquinarias.descripcion,asignar_maquinarias.estado'))
                ->join('ficha_tecnicas', 'ficha_tecnicas.id', '=', 'asignar_maquinarias.fichatecnica_id')
                ->join('personas', 'personas.id', '=', 'asignar_maquinarias.persona_id')
                ->where('asignar_maquinarias.id', '=', $desencriptando)
                ->get();
            return response()->json($asignacion);
        }
    }

    public function destroy($id)
    {
        $desencriptando = Hashids::decode($id);
        $contar=count($desencriptando);
        if($contar==0){
            return view('errors.500');
        }else {
            $desencriptando = Hashids::decode($id)[0];
            AsignarMaquinaria::destroy($desencriptando);
            return response()->json(["mensaje" => "exitosamente"]);
        }
    }
}
