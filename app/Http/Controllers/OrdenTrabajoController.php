<?php

namespace App\Http\Controllers;

use App\FichaTecnica;
use App\Http\Requests\CrearOrdenTrabajoRequest;
use App\OrdenTrabajo;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use Hashids;
class OrdenTrabajoController extends Controller
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
        $maquinarias=FichaTecnica::select('id','descripcion')->get();
        return view('ordenTrabajo.index',compact('maquinarias'));
    }
    public function getOrdenTrabajo(){
        $ordentrabajos=OrdenTrabajo::select('id','fecha','nombre_maquinaria','tipo_mtto','localizacion_averia')->where('estado','=','1')->get();
        return Datatables::of($ordentrabajos)->addColumn('action', function ($ordentrabajo) {
            $encriptado=Hashids::encode($ordentrabajo->id);
            return "<div class='btn-group'>
            <button value=".$encriptado." OnClick='Ver(this);'  class='btn btn-info' ><i class='md  md-remove-red-eye'></i></button>
            <button value=".$encriptado." OnClick='Mostrar(this);'  data-toggle='modal' data-target='#myModal2' class='btn btn-primary '><i class=' ion-edit'></i></button>
            <button value=".$encriptado." OnClick='Eliminar(this);' data-toggle='modal' data-target='#myModal9' class='btn btn-danger '><i class=' ion-trash-a'></i></button>
             <div>";
        })
            ->editColumn('id', function($ordentrabajos) {
                $conca='OT'.str_pad($ordentrabajos->id, 4, "0", STR_PAD_LEFT);
                return $conca;
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(CrearOrdenTrabajoRequest $request)
    {
        $maquinaria_id=$request->input('maquinaria_id');
        $kilometraje=$request->input('kilometraje');
        $horometro=$request->input('horometro');
        $loca_averia=$request->input('loca_averia');
        $tipo_mantenimiento=$request->input('tipo_mantenimiento');
        $descripcion_trabajo=$request->input('descripcion_trabajo');
        $duracion_tarea=$request->input('duracion_tarea');
        $cantidad_personal=$request->input('cantidad_personal');
        $codigo_material=$request->input('codigo_material');
        $cantidad=$request->input('cantidad');
        $observacion=$request->input('observacion');

        $ficha_tecnica=FichaTecnica::find($maquinaria_id);
        $nombre_maquinaria=$ficha_tecnica->descripcion;
        $marca_maquinaria=$ficha_tecnica->marca;
        $modelo_maquinaria=$ficha_tecnica->modelo;
        $serie_maquinaria=$ficha_tecnica->serie;

        $ordentrabajo=new OrdenTrabajo();
        $ordentrabajo->idMAQ=$maquinaria_id;
        $ordentrabajo->nombre_maquinaria=$nombre_maquinaria;
        $ordentrabajo->marca_maquinaria=$marca_maquinaria;
        $ordentrabajo->modelo_maquinaria=$modelo_maquinaria;
        $ordentrabajo->serie_maquinaria=$serie_maquinaria;
        $ordentrabajo->kilometraje=$kilometraje;
        $ordentrabajo->horometro=$horometro;
        $ordentrabajo->fecha=date('Y-m-d');
        $ordentrabajo->localizacion_averia=$loca_averia;
        $ordentrabajo->tipo_mtto=$tipo_mantenimiento;
        $ordentrabajo->descripcion_trabajo=$descripcion_trabajo;
        $ordentrabajo->duracion_tarea=$duracion_tarea;
        $ordentrabajo->cant_personal=$cantidad_personal;
        $ordentrabajo->cod_material=$codigo_material;
        $ordentrabajo->cantidad=$cantidad;
        $ordentrabajo->observacion=$observacion;
        $ordentrabajo->estado=1;
        $ordentrabajo->save();
        return response()->json(["mensaje"=>"exitoso"]);

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
            $orden_trabajo = OrdenTrabajo::find($desencriptando);
            //$descripcion_trabjos=$orden_trabajo->descripcion_trabajo;
            //$array=explode('-',$descripcion_trabjos);
            return response()->json($orden_trabajo);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $desencriptando = Hashids::decode($id);
        $contar=count($desencriptando);
        if($contar==0){
            return view('errors.500');
        }else {
            $desencriptando = Hashids::decode($id)[0];
            $maquinaria_id = $request->input('maquinaria_id');
            $kilometraje = $request->input('kilometraje');
            $horometro = $request->input('horometro');
            $loca_averia = $request->input('loca_averia');
            $tipo_mantenimiento = $request->input('tipo_mantenimiento');
            $descripcion_trabajo = $request->input('descripcion_trabajo');
            $duracion_tarea = $request->input('duracion_tarea');
            $cantidad_personal = $request->input('cantidad_personal');
            $codigo_material = $request->input('codigo_material');
            $cantidad = $request->input('cantidad');
            $observacion = $request->input('observacion');

            $ficha_tecnica = FichaTecnica::find($maquinaria_id);
            $nombre_maquinaria = $ficha_tecnica->descripcion;
            $marca_maquinaria = $ficha_tecnica->marca;
            $modelo_maquinaria = $ficha_tecnica->modelo;
            $serie_maquinaria = $ficha_tecnica->serie;

            $ordentrabajo = OrdenTrabajo::find($desencriptando);
            $ordentrabajo->idMAQ = $maquinaria_id;
            $ordentrabajo->nombre_maquinaria = $nombre_maquinaria;
            $ordentrabajo->marca_maquinaria = $marca_maquinaria;
            $ordentrabajo->modelo_maquinaria = $modelo_maquinaria;
            $ordentrabajo->serie_maquinaria = $serie_maquinaria;
            $ordentrabajo->kilometraje = $kilometraje;
            $ordentrabajo->horometro = $horometro;
            $ordentrabajo->localizacion_averia = $loca_averia;
            $ordentrabajo->tipo_mtto = $tipo_mantenimiento;
            $ordentrabajo->descripcion_trabajo = $descripcion_trabajo;
            $ordentrabajo->duracion_tarea = $duracion_tarea;
            $ordentrabajo->cant_personal = $cantidad_personal;
            $ordentrabajo->cod_material = $codigo_material;
            $ordentrabajo->cantidad = $cantidad;
            $ordentrabajo->observacion = $observacion;
            $ordentrabajo->estado = 1;
            $ordentrabajo->save();
            return response()->json(["mensaje" => "exitosamente"]);
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
             OrdenTrabajo::destroy($desencriptando);
            return response()->json(["mensaje" => "exitosamente"]);
        }
    }
}
