<?php

namespace App\Http\Controllers;

use App\AltaMantenimiento;
use App\Calendario;
use App\FichaTecnica;
use App\Http\Requests\CrearAltaMantenimientoRequest;
use App\Http\Requests\CrearMantenimientoRequest;
use App\Mantenimiento;
use App\OrdenTrabajo;
use App\Proveedor;
use App\User;
use App\UsoMaquinaria;
use Illuminate\Http\Request;
Use DB;
Use Hashids;

use Yajra\Datatables\Facades\Datatables;

class MantenimientosController extends Controller
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
        /*
         *  SELECT  concat(p.nombre,' ',p.apellidoPat,' ',p.apellidoMat)ncompletos FROM users AS u
            INNER JOIN personas AS p ON u.id = p.user_id
            WHERE u.tipousuario_id=2
         */
        $operarios=User::select(DB::raw('CONCAT(personas.nombre," ",personas.apellidoPat," ",personas.apellidoMat)AS ncompletos'))
            ->join('personas','personas.user_id','=','users.id')
            ->where('users.tipousuario_id','=','2')
            ->get();
        $equipos=FichaTecnica::Select('id','descripcion')->get();
        $proveedores=Proveedor::Select('id','razonsocial')->where('id','<>',1)->get();
        //SELECT id,concat('OT',LPAD(id,4,'0'))ordenes FROM orden_trabajos WHERE estado=1
        $ordentrabajos=OrdenTrabajo::Select(DB::raw('id,CONCAT("OT",LPAD(id,4,"0"))AS ordentrabajo'))->where('estado','=',1)->get();
        return view('mantenimientos.index',compact('equipos','operarios','proveedores','ordentrabajos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMantenimientos(){

        /*
        $mantenimientos=Mantenimiento::select(DB::raw('mantenimientos.id,(mantenimientos.detalle)AS mantenimiento,(ficha_tecnicas.descripcion)AS equipo,(uso_maquinarias.detalle)AS uso,(uso_maquinarias.final_horometro),mantenimientos.limite_horometro,mantenimientos.fecha_mantenimiento'))
            ->join('ficha_tecnicas','ficha_tecnicas.id','=','mantenimientos.fichatecnica_id')
            ->join('uso_maquinarias','uso_maquinarias.fichatecnica_id','=','ficha_tecnicas.id')
            ->orderby('uso_maquinarias.final_horometro','DESC')->take($count)->get();*/
        $rangos=UsoMaquinaria::select(DB::raw('uso_maquinarias.fichatecnica_id,uso_maquinarias.final_horometro'))
            ->leftJoin('uso_maquinarias as u1', function($join){
                $join->on('uso_maquinarias.fichatecnica_id', '=',
                    DB::raw('u1.fichatecnica_id AND uso_maquinarias.final_horometro < u1.final_horometro '));
            })
            ->whereNull('u1.final_horometro')
            ->get();
        $i=0;
        $array=[];
        foreach($rangos as $rango){
            $array[$i]=$rango->final_horometro;
            $i++;
        }
        $mantenimientos=Mantenimiento::select(DB::raw('mantenimientos.id,(mantenimientos.detalle)AS mantenimiento,(ficha_tecnicas.descripcion)AS equipo,(uso_maquinarias.detalle)AS uso,(uso_maquinarias.final_horometro),mantenimientos.limite_horometro,mantenimientos.fecha_mantenimiento'))
            ->join('ficha_tecnicas','ficha_tecnicas.id','=','mantenimientos.fichatecnica_id')
            ->join('uso_maquinarias','uso_maquinarias.fichatecnica_id','=','ficha_tecnicas.id')
            ->whereIn('uso_maquinarias.final_horometro', $array)
            ->where('mantenimientos.estado','=',1)
            ->get();

        //<i class='fa fa-circle' style='color: #ed3c39' aria-hidden='true'></i>
        //<i class='fa fa-circle' style='color: #009886' aria-hidden='true'></i>
        return Datatables::of($mantenimientos)
            ->addColumn('estado', function ($mantenimiento) {

                $fecha_actual=date('Y-m-d');
                if($mantenimiento->fecha_mantenimiento==''){
                        if ($mantenimiento->limite_horometro<=$mantenimiento->final_horometro){
                        return "<i class='fa fa-circle' style='color: #ed3c39' aria-hidden='true'></i>";
                        }else{
                            return "<i class='fa fa-circle' style='color: #009886' aria-hidden='true'></i>";
                        }
                    }
                   else{
                       if($mantenimiento->fecha_mantenimiento<=$fecha_actual){
                           return "<i class='fa fa-circle' style='color: #ed3c39' aria-hidden='true'></i>";
                       }
                    else{
                        return "<i class='fa fa-circle' style='color: #009886' aria-hidden='true'></i>";
                        }
                   }
            })
            ->addColumn('action', function ($mantenimiento) {
                $encriptado=Hashids::encode($mantenimiento->id);
                return "<div class='btn-group'>
                            <button value=".$encriptado." OnClick='AltaMantenimiento(this);'  data-toggle='modal' data-target='#myModal7' class='btn btn-success '><i class=' ion-checkmark'></i></button>
                        <div>";
              /*
                $fecha_actual=date('Y-m-d');
                if($mantenimiento->fecha_mantenimiento==''){
                    if ($mantenimiento->limite_horometro<=$mantenimiento->final_horometro){
                        return "<div class='btn-group'>
                                <button value=".$mantenimiento->id." OnClick='Ver(this);' data-toggle='modal' data-target='#myModal5'  class='btn btn-default'  ><i class='ion-ios7-search-strong'></i></button>
                                <button value=".$mantenimiento->id." OnClick='Mostrar(this);'  data-toggle='modal' data-target='#myModal7' class='btn btn-success '><i class=' ion-checkmark'></i></button>
                                <button value=".$mantenimiento->id." OnClick='Eliminar(this);' data-toggle='modal' data-target='#myModal9' class='btn btn-danger '><i class=' ion-close'></i></button>
                                 <div>";
                    }else{
                        return "<div class='btn-group'>
                                <button value=".$mantenimiento->id." OnClick='Ver(this);' data-toggle='modal' data-target='#myModal5'  class='btn btn-default'  ><i class='ion-ios7-search-strong'></i></button>
                                <button value=".$mantenimiento->id." OnClick='Mostrar(this);'  data-toggle='modal' data-target='#myModal7' class='btn btn-success ' disabled><i class=' ion-checkmark'></i></button>
                                <button value=".$mantenimiento->id." OnClick='Eliminar(this);' data-toggle='modal' data-target='#myModal9' class='btn btn-danger '><i class=' ion-close'></i></button>
                                 <div>";
                    }
                }
                else{
                    if($mantenimiento->fecha_mantenimiento<=$fecha_actual){
                        return "<div class='btn-group'>
                                <button value=".$mantenimiento->id." OnClick='Ver(this);' data-toggle='modal' data-target='#myModal5'  class='btn btn-default'  ><i class='ion-ios7-search-strong'></i></button>
                                <button value=".$mantenimiento->id." OnClick='Mostrar(this);'  data-toggle='modal' data-target='#myModal7' class='btn btn-success '><i class=' ion-checkmark'></i></button>
                                <button value=".$mantenimiento->id." OnClick='Eliminar(this);' data-toggle='modal' data-target='#myModal9' class='btn btn-danger '><i class=' ion-close'></i></button>
                                 <div>";
                    }
                    else{
                        return "<div class='btn-group'>
                                <button value=".$mantenimiento->id." OnClick='Ver(this);' data-toggle='modal' data-target='#myModal5'  class='btn btn-default'  ><i class='ion-ios7-search-strong'></i></button>
                                <button value=".$mantenimiento->id." OnClick='Mostrar(this);'  data-toggle='modal' data-target='#myModal7' class='btn btn-success ' disabled><i class=' ion-checkmark'></i></button>
                                <button value=".$mantenimiento->id." OnClick='Eliminar(this);' data-toggle='modal' data-target='#myModal9' class='btn btn-danger '><i class=' ion-close'></i></button>
                                 <div>";
                    }
                }
                */
            })
            ->editColumn('fecha_mantenimiento', function($mantenimientos) {
                if($mantenimientos->limite_horometro!=''){
                    return "<i class='fa fa-times' aria-hidden='true'></i>";
                } else{ return $mantenimientos->fecha_mantenimiento ;}

            })
            ->editColumn('final_horometro', function($mantenimientos) {
                if($mantenimientos->fecha_mantenimiento!=''){
                    return "<i class='fa fa-times' aria-hidden='true'></i>";
                } else{ return $mantenimientos->final_horometro ;}

            })
            ->editColumn('limite_horometro', function($mantenimientos) {
                if($mantenimientos->fecha_mantenimiento!=''){
                    return "<i class='fa fa-times' aria-hidden='true'></i>";
                } else{ return $mantenimientos->limite_horometro ;}

            })
            ->editColumn('id', function($mantenimientos) {
                $conca='MT'.str_pad($mantenimientos->id, 4, "0", STR_PAD_LEFT);
                return $conca;
            })
            ->make(true);

        /*
        $id = Mantenimiento::all()->pluck('id');
        $count = count($id);

        $mantenimientos=Mantenimiento::select(DB::raw('mantenimientos.id,(mantenimientos.detalle)AS mantenimiento,(ficha_tecnicas.descripcion)AS equipo,(uso_maquinarias.detalle)AS uso,(uso_maquinarias.final_horometro),mantenimientos.limite_horometro,mantenimientos.fecha_inicial'))
            ->join('ficha_tecnicas','ficha_tecnicas.id','=','mantenimientos.fichatecnica_id')
            ->join('uso_maquinarias','uso_maquinarias.fichatecnica_id','=','ficha_tecnicas.id')
            ->orderby('uso_maquinarias.final_horometro','DESC')->take($count)->get();

        return Datatables::of($mantenimientos)

            ->addColumn('estado', function ($mantenimiento) {
            return "hola";
        })
            ->addColumn('action', function ($mantenimiento) {
                return "<div class='btn-group'>
            <button value=".$mantenimiento->id." OnClick='Ver(this);' data-toggle='modal' data-target='#myModal5'  class='btn btn-info' ><i class='md  md-remove-red-eye'></i></button>
            <button value=".$mantenimiento->id." OnClick='Mostrar(this);'  data-toggle='modal' data-target='#myModal2' class='btn btn-primary '><i class=' ion-edit'></i></button>
            <button value=".$mantenimiento->id." OnClick='Eliminar(this);' data-toggle='modal' data-target='#myModal9' class='btn btn-danger '><i class=' ion-trash-a'></i></button>
             <div>";
            })
            ->editColumn('fecha_inicial', function($mantenimientos) {
            if($mantenimientos->limite_horometro!=''){
                return "<i class='fa fa-times' aria-hidden='true'></i>";
            } else{ return $mantenimientos->fecha_inicial ;}

        })
            ->editColumn('final_horometro', function($mantenimientos) {
                if($mantenimientos->fecha_inicial!=''){
                    return "<i class='fa fa-times' aria-hidden='true'></i>";
                } else{ return $mantenimientos->final_horometro ;}

            })
            ->editColumn('limite_horometro', function($mantenimientos) {
                if($mantenimientos->fecha_inicial!=''){
                    return "<i class='fa fa-times' aria-hidden='true'></i>";
                } else{ return $mantenimientos->limite_horometro ;}

            })
            ->make(true);
        */
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
    public function store(CrearMantenimientoRequest $request)
    {
        $tipo_mantenimiento="Preventivo";
        $ficha=$request->input('fichatecnica_id');
        $detalle=$request->input('detalle');
        $fecha_inicial=$request->input('fecha_inicial');
        $limite_horometro=$request->input('limite_horometro');
        $estado=$request->input('estado');
        $dias=$request->input('dias');
        if($limite_horometro>0){
                $mantenimiento=new Mantenimiento();
                $mantenimiento->fichatecnica_id=$ficha;
                $mantenimiento->tipo_mantenimiento=$tipo_mantenimiento;
                $mantenimiento->detalle=$detalle;
                $mantenimiento->limite_horometro=$limite_horometro;
                $mantenimiento->estado=$estado;
                $mantenimiento->save();
        }else{
            if($dias>0){
                $mantenimiento=new Mantenimiento();
                $fecha_mantenimiento=$this->calculaFecha("days",$dias,$fecha_inicial);
                $mantenimiento->fichatecnica_id=$ficha;
                $mantenimiento->tipo_mantenimiento=$tipo_mantenimiento;
                $mantenimiento->detalle=$detalle;
                $mantenimiento->fecha_inicial=$fecha_inicial;
                $mantenimiento->fecha_mantenimiento=$fecha_mantenimiento;
                $mantenimiento->estado=$estado;
                $mantenimiento->dias=$dias;
                $mantenimiento->save();

                //$id_mante=Mantenimiento::select('id')->orderby('created_at','DESC')->take(1)->get();
                $id_mante=Mantenimiento::select(['mantenimientos.id','ficha_tecnicas.descripcion'])
                    ->join('ficha_tecnicas','mantenimientos.fichatecnica_id','=','ficha_tecnicas.id')
                    ->orderby('mantenimientos.created_at','DESC')->take(1)->get();
                $id_m='';
                $des_m='';
                foreach($id_mante as $id){
                    $id_m=$id->id;
                    $des_m=$id->descripcion;
                }

                $fecha_incial2=$this->calculaFecha("days",0,$fecha_inicial);
                $fecha_final=$this->calculaFecha("days",$dias,$fecha_inicial);

                $calendario=new Calendario();
                $calendario->mantenimiento_id=$id_m;
                $calendario->titulo=$detalle;
                $calendario->fecha_inicial=$fecha_incial2;
                $calendario->fecha_final=$fecha_final;
                $calendario->todoeldia=1;
                $calendario->color="#ef5350";
                $calendario->descripcion=$des_m;
                $calendario->estado=$estado;
                $calendario->save();
            }
            else{

            }

        }
        return response()->json(["mensaje"=>$detalle]);
    }

    public function calculaFecha($modo,$valor,$fecha_inicio=false){

        if($fecha_inicio!=false) {
            $fecha_base = strtotime($fecha_inicio);
        }else {
            $time=time();
            $fecha_actual=date("Y-m-d",$time);
            $fecha_base=strtotime($fecha_actual);
        }

        $calculo = strtotime("$valor $modo","$fecha_base");

        return date("Y-m-d", $calculo);

    }
    public function altaMantenimientos(CrearAltaMantenimientoRequest $request){

        $id=$request->input('mantenimiento_id');
        $proveedor=$request->input('proveedor_id');
        $interno=$request->input('interno');
        $costo=$request->input('costo');
        $observacion=$request->input('observacion');
        $descripcion=$request->input('descripcion');
        $path=$request->input('path');
        $ordenTrabajo=$request->input('ordentrabajo_id');

        $Amantenimiento2 = Mantenimiento::find($id);
        $nficha_tecnica_id = $Amantenimiento2->fichatecnica_id;
        $ntipo_mantenimiento = $Amantenimiento2->tipo_mantenimiento;
        $ndetalle = $Amantenimiento2->detalle;
        $ndias=$Amantenimiento2->dias;
        $nfecha_inicial = $request->input('Nfecha_inicial');
        $nfecha_mantenimiento = $this->calculaFecha("days", $ndias, $nfecha_inicial);
        $nlimite_horometro = $request->input('Nhorometro');
        $estado = 1;
        $Amantenimiento2->estado=0;
        $Amantenimiento2->save();

        if ($nlimite_horometro == "" && $nfecha_inicial!="") {
            $mantenimiento = new Mantenimiento();
            $mantenimiento->fichatecnica_id = $nficha_tecnica_id;
            $mantenimiento->tipo_mantenimiento = $ntipo_mantenimiento;
            $mantenimiento->detalle = $ndetalle;
            $mantenimiento->fecha_inicial = $nfecha_inicial;
            $mantenimiento->dias=$ndias;
            $mantenimiento->fecha_mantenimiento = $nfecha_mantenimiento;
            $mantenimiento->estado = $estado;
            $mantenimiento->save();

            $id_mante=Mantenimiento::select(['mantenimientos.id','ficha_tecnicas.descripcion'])
                ->join('ficha_tecnicas','mantenimientos.fichatecnica_id','=','ficha_tecnicas.id')
                ->orderby('mantenimientos.created_at','DESC')->take(1)->get();
            $id_m='';
            $des_m='';
            foreach($id_mante as $id){
                $id_m=$id->id;
                $des_m=$id->descripcion;
            }
            Calendario::where('mantenimiento_id',$id_m)->delete();
            $calendario=new Calendario();
            $calendario->mantenimiento_id=$id_m;
            $calendario->titulo=$ndetalle;
            $calendario->fecha_inicial=$nfecha_inicial;
            $calendario->fecha_final=$nfecha_mantenimiento;
            $calendario->todoeldia=1;
            $calendario->color="#ef5350";
            $calendario->descripcion=$des_m;
            $calendario->estado=$estado;
            $calendario->save();
            if($proveedor==""){
                    $alta_mantenimiento=new AltaMantenimiento($request->all());
                    $alta_mantenimiento->ordentrabajo_id=$ordenTrabajo;
                    $alta_mantenimiento->proveedor_id=1;
                    $alta_mantenimiento->interno=$interno;
                    $alta_mantenimiento->costo=$costo;
                    $alta_mantenimiento->descripcion=$descripcion;
                    $alta_mantenimiento->observacion=$observacion;
                    $alta_mantenimiento->Nfecha_mantenimiento=$nfecha_mantenimiento;
                    $alta_mantenimiento->estado=1;
                    $alta_mantenimiento->save();
            }
            else{
                    $alta_mantenimiento=new AltaMantenimiento($request->all());
                    $alta_mantenimiento->ordentrabajo_id=$ordenTrabajo;
                    $alta_mantenimiento->costo=$costo;
                    $alta_mantenimiento->descripcion=$descripcion;
                    $alta_mantenimiento->observacion=$observacion;
                    $alta_mantenimiento->Nfecha_mantenimiento=$nfecha_mantenimiento;
                    $alta_mantenimiento->estado=1;
                    $alta_mantenimiento->save();
                }

        } else{
            if($nlimite_horometro != "" && $nfecha_inicial=="") {
            $mantenimiento = new Mantenimiento();
            $mantenimiento->fichatecnica_id = $nficha_tecnica_id;
            $mantenimiento->tipo_mantenimiento = $ntipo_mantenimiento;
            $mantenimiento->detalle = $ndetalle;
            $mantenimiento->limite_horometro = $nlimite_horometro;
            $mantenimiento->estado = $estado;
            $mantenimiento->save();
                if($proveedor==""){
                        $alta_mantenimiento=new AltaMantenimiento($request->all());
                        $alta_mantenimiento->ordentrabajo_id=$ordenTrabajo;
                        $alta_mantenimiento->proveedor_id=1;
                        $alta_mantenimiento->interno=$interno;
                        $alta_mantenimiento->costo=$costo;
                        $alta_mantenimiento->descripcion=$descripcion;
                        $alta_mantenimiento->observacion=$observacion;
                        $alta_mantenimiento->Nlimite_horometro=$nlimite_horometro;
                        $alta_mantenimiento->estado=1;
                        $alta_mantenimiento->save();
                }
                else{

                        $alta_mantenimiento=new AltaMantenimiento($request->all());
                        $alta_mantenimiento->ordentrabajo_id=$ordenTrabajo;
                        $alta_mantenimiento->costo=$costo;
                        $alta_mantenimiento->descripcion=$descripcion;
                        $alta_mantenimiento->observacion=$observacion;
                        $alta_mantenimiento->Nlimite_horometro=$nlimite_horometro;
                        $alta_mantenimiento->estado=1;
                        $alta_mantenimiento->save();
                }
            }
        }


        return response()->json(["mensaje"=>"exitosamente"]);

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
        if($contar==0) {
            return view('errors.500');
        }else{
            $desencriptando=Hashids::decode($id)[0];
            $mantenimiento=Mantenimiento::find($desencriptando);
            return response()->json($mantenimiento);
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
        }else{
            $desencriptando=Hashids::decode($id)[0];
            $tipo_mantenimiento="Preventivo";
            $ficha=$request->input('fichatecnica_id');
            $detalle=$request->input('detalle');
            $fecha_inicial=$request->input('fecha_inicial');
            $limite_horometro=$request->input('limite_horometro');
            $estado=$request->input('estado');
            $dias=$request->input('dias');

            $mantenimiento=Mantenimiento::find($desencriptando);
            $mantenimiento_horometro=$mantenimiento->limite_horometro;
            $mantenimiento_fecha=$mantenimiento->fecha_mantenimiento;
            if(($mantenimiento_horometro==null && $limite_horometro!="") || (($mantenimiento_fecha!=null || $mantenimiento_fecha==null) && $fecha_inicial=="")){

                $mantenimiento=Mantenimiento::find($desencriptando);
                $mantenimiento->fichatecnica_id=$ficha;
                $mantenimiento->tipo_mantenimiento=$tipo_mantenimiento;
                $mantenimiento->detalle=$detalle;
                $mantenimiento->limite_horometro=$limite_horometro;
                $mantenimiento->fecha_inicial = null;
                $mantenimiento->fecha_mantenimiento = null;
                $mantenimiento->estado = $estado;
                $mantenimiento->dias = null;
                $mantenimiento->save();
                Calendario::where('mantenimiento_id',$desencriptando)->delete();
            }else {
                if((($mantenimiento_horometro==null || $mantenimiento_horometro!=null) && $limite_horometro=="" )||($mantenimiento_fecha==null && $fecha_inicial!=""))
                {
                    if($dias>0 && $fecha_inicial!="") {
                        $fecha_mantenimiento = $this->calculaFecha("days", $dias, $fecha_inicial);
                        $mantenimiento=Mantenimiento::find($desencriptando);
                        $mantenimiento->fichatecnica_id = $ficha;
                        $mantenimiento->tipo_mantenimiento = $tipo_mantenimiento;
                        $mantenimiento->detalle = $detalle;
                        $mantenimiento->fecha_inicial = $fecha_inicial;
                        $mantenimiento->fecha_mantenimiento = $fecha_mantenimiento;
                        $mantenimiento->limite_horometro=null;
                        $mantenimiento->estado = $estado;
                        $mantenimiento->dias = $dias;
                        $mantenimiento->save();
                        Calendario::where('mantenimiento_id',$desencriptando)->delete();
                        $id_mante = Mantenimiento::select(['mantenimientos.id', 'ficha_tecnicas.descripcion'])
                            ->join('ficha_tecnicas', 'mantenimientos.fichatecnica_id', '=', 'ficha_tecnicas.id')
                            ->orderby('mantenimientos.updated_at', 'DESC')->take(1)->get();
                        $id_m = '';
                        $des_m = '';
                        foreach ($id_mante as $id) {
                            $id_m = $id->id;
                            $des_m = $id->descripcion;
                        }
                        $fecha_incial2 = $this->calculaFecha("days", 0, $fecha_inicial);
                        $fecha_final = $this->calculaFecha("days", $dias, $fecha_inicial);

                        $calendario = new Calendario();
                        $calendario->mantenimiento_id = $id_m;
                        $calendario->titulo = $detalle;
                        $calendario->fecha_inicial = $fecha_incial2;
                        $calendario->fecha_final = $fecha_final;
                        $calendario->todoeldia = 1;
                        $calendario->color = "#ef5350";
                        $calendario->descripcion = $des_m;
                        $calendario->estado = $estado;
                        $calendario->save();
                    }

                }
                else{
                    dd("INGRESE DATOS CORRECTOS");
                }

            }
            return response()->json(["mensaje"=>$detalle]);
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
        }else{
            $desencriptando=Hashids::decode($id)[0];
            $mantenimiento= Mantenimiento::find($desencriptando);
            $mantenimiento->delete();
            $calendario=Calendario::where('mantenimiento_id',$desencriptando);
            $calendario->delete();
            return response()->json(["mensaje"=>"exitosamente"]);
        }

    }
    public function historialMantenimientos(){
        return view('mantenimientos.historialMantenimientos');
    }
    public function getMantenimientos_historial()
    {
        $mantenimientos=Mantenimiento::select(DB::raw('mantenimientos.id,(mantenimientos.detalle)AS mantenimiento,(ficha_tecnicas.descripcion)AS equipo,mantenimientos.limite_horometro,mantenimientos.fecha_inicial,mantenimientos.fecha_mantenimiento'))
            ->join('ficha_tecnicas','ficha_tecnicas.id','=','mantenimientos.fichatecnica_id')
            ->where('mantenimientos.estado','=',1)
            ->get();

        return Datatables::of($mantenimientos)

            ->editColumn('fecha_inicial', function($mantenimientos) {
                if($mantenimientos->limite_horometro!=''){
                    return "<i class='fa fa-times' aria-hidden='true'></i>";
                } else{ return $mantenimientos->fecha_inicial;}

            })
            ->editColumn('fecha_mantenimiento', function($mantenimientos) {
                if($mantenimientos->limite_horometro!=''){
                    return "<i class='fa fa-times' aria-hidden='true'></i>";
                } else{ return $mantenimientos->fecha_mantenimiento ;}

            })
            ->editColumn('limite_horometro', function($mantenimientos) {
                if($mantenimientos->fecha_mantenimiento!=''){
                    return "<i class='fa fa-times' aria-hidden='true'></i>";
                } else{ return $mantenimientos->limite_horometro ;}

            })
            ->editColumn('id', function($mantenimientos) {
                $conca='MT'.str_pad($mantenimientos->id, 4, "0", STR_PAD_LEFT);
                return $conca;
            })
            ->addColumn('action', function ($mantenimientos) {
                $encriptado=Hashids::encode($mantenimientos->id);
                return "<div class='btn-group'>
            <button value=".$encriptado." OnClick='Mostrar(this);'  data-toggle='modal' data-target='#myModal2' class='btn btn-primary '><i class=' ion-edit'></i></button>
            <button value=".$encriptado." OnClick='Eliminar(this);' data-toggle='modal' data-target='#myModal9' class='btn btn-danger '><i class=' ion-trash-a'></i></button>
             <div>";
            })
            ->make(true);


    }
    public function getMantenimientos_Interno()
    {
        /*
         * SELECT am.id,(m.detalle)mantenimiento,ft.descripcion,p.razonsocial,am.interno,am.costo,am.observacion FROM alta_mantenimientos AS am
            INNER JOIN mantenimientos AS m ON am.mantenimiento_id = m.id
            INNER JOIN ficha_tecnicas AS ft ON m.fichatecnica_id = ft.id
            INNER JOIN proveedors AS p ON am.proveedor_id = p.id
         */
        $interno=AltaMantenimiento::select(DB::raw('alta_mantenimientos.id,alta_mantenimientos.ordentrabajo_id AS orden,(mantenimientos.detalle)AS mantenimiento,(ficha_tecnicas.descripcion)AS equipo,proveedors.razonsocial,alta_mantenimientos.interno,alta_mantenimientos.costo'))
            ->join('mantenimientos','mantenimientos.id','=','alta_mantenimientos.mantenimiento_id')
            ->join('ficha_tecnicas','ficha_tecnicas.id','=','mantenimientos.fichatecnica_id')
            ->join('proveedors','proveedors.id','=','alta_mantenimientos.proveedor_id')
            ->where('alta_mantenimientos.proveedor_id','=',1)
            ->get();

        return Datatables::of($interno)

            ->editColumn('interno', function($interno) {
                if($interno->interno!=''){
                    return $interno->interno;
                } else{ return "<i class='fa fa-times' aria-hidden='true'></i>";}

            })
            ->editColumn('id', function($interno) {
                $conca='AL'.str_pad($interno->id, 4, "0", STR_PAD_LEFT);
                return $conca;
            })
            ->addColumn('action', function ($interno) {
                $encriptadoREporte=Hashids::encode($interno->id);
                $encriptadoOrden=Hashids::encode($interno->orden);
                return "<div class='btn-group'>
                        <div class='btn-group dropup'>
                                <button type='button' class='btn btn-info dropdown-toggle waves-effect waves-light' data-toggle='dropdown' aria-expanded='false'><i class='md  md-remove-red-eye'></i> <span class='caret'></span></button>
                                <ul class='dropdown-menu' role='menu'>
                                    <li><a href='MantenimientoPDF/".$encriptadoREporte."' target='_blank'>Reporte de MTTO</a></li>
                                    <li><a href='OrdenTrabajoPDF/".$encriptadoOrden."' target='_blank'>Orden de Trabajo</a></li>
                                </ul>
                         </div>
            <button value=".$interno->id." OnClick='Mostrar(this);'  data-toggle='modal' data-target='#myModal2' class='btn btn-primary '><i class=' ion-edit'></i></button>
            <button value=".$interno->id." OnClick='Eliminar(this);' data-toggle='modal' data-target='#myModal9' class='btn btn-danger '><i class=' ion-trash-a'></i></button>
             <div>";
            })
            ->make(true);

    }
    public function getMantenimientos_Proveedor()
    {
        /*
         * SELECT am.id,(m.detalle)mantenimiento,ft.descripcion,p.razonsocial,am.interno,am.costo,am.observacion FROM alta_mantenimientos AS am
            INNER JOIN mantenimientos AS m ON am.mantenimiento_id = m.id
            INNER JOIN ficha_tecnicas AS ft ON m.fichatecnica_id = ft.id
            INNER JOIN proveedors AS p ON am.proveedor_id = p.id
         */
        $proveedor=AltaMantenimiento::select(DB::raw('alta_mantenimientos.id,alta_mantenimientos.ordentrabajo_id AS orden,(mantenimientos.detalle)AS mantenimiento,(ficha_tecnicas.descripcion)AS equipo,proveedors.razonsocial,alta_mantenimientos.interno,alta_mantenimientos.costo'))
            ->join('mantenimientos','mantenimientos.id','=','alta_mantenimientos.mantenimiento_id')
            ->join('ficha_tecnicas','ficha_tecnicas.id','=','mantenimientos.fichatecnica_id')
            ->join('proveedors','proveedors.id','=','alta_mantenimientos.proveedor_id')
            ->where('alta_mantenimientos.proveedor_id','<>',1)
            ->get();

        return Datatables::of($proveedor)

            ->editColumn('interno', function($proveedor) {
                if($proveedor->$proveedor!=''){
                    return $proveedor->interno;
                } else{ return "<i class='fa fa-times' aria-hidden='true'></i>";}

            })
            ->editColumn('id', function($proveedor) {
                $conca='AL'.str_pad($proveedor->id, 4, "0", STR_PAD_LEFT);
                return $conca;
            })
            ->addColumn('action', function ($proveedor) {
                $encriptadoREporte=Hashids::encode($proveedor->id);
                $encriptadoOrden=Hashids::encode($proveedor->orden);
                return "<div class='btn-group'>
                        <div class='btn-group dropup'>
                                <button type='button' class='btn btn-info dropdown-toggle waves-effect waves-light' data-toggle='dropdown' aria-expanded='false'><i class='md  md-remove-red-eye'></i> <span class='caret'></span></button>
                                <ul class='dropdown-menu' role='menu'>
                                    <li><a href='MantenimientoPDF/".$encriptadoREporte."' target='_blank'>Reporte de MTTO</a></li>
                                    <li><a href='OrdenTrabajoPDF/".$encriptadoOrden."' target='_blank'>Orden de Trabajo</a></li>
                                    <li><a href='Certificado/".$encriptadoREporte."' >Certificado</a></li>
                                </ul>
                         </div>
            <button value=".$proveedor->id." OnClick='Mostrar(this);'  data-toggle='modal' data-target='#myModal28' class='btn btn-primary '><i class=' ion-edit'></i></button>
            <button value=".$proveedor->id." OnClick='Eliminar(this);' data-toggle='modal' data-target='#myModal9' class='btn btn-danger '><i class=' ion-trash-a'></i></button>
             <div>";
            })
            ->make(true);

    }
    public function AddMantenimientoCorrectivo(Request $request){
      $fichatecnica=$request->input('fichatecnica_id');
      $tipo_mtto="Correctivo";
      $detalle=$request->input('detalle');
      $proveedor=$request->input('proveedor_id');
      $orden_trabajo=$request->input('ordentrabajo_id');
      $costo=$request->input('costo');
      $descripcion=$request->input('descripcion');
      $observacion=$request->input('observacion');
      $interno=$request->input('interno');

      $mantenimento=new Mantenimiento();
      $mantenimento->fichatecnica_id=$fichatecnica;
      $mantenimento->tipo_mantenimiento=$tipo_mtto;
      $mantenimento->detalle=$detalle;
      $mantenimento->estado=0;
      $mantenimento->save();
        $id_mante=Mantenimiento::select('mantenimientos.id')
            ->orderby('mantenimientos.created_at','DESC')->take(1)->get();
        $id_m='';
        foreach($id_mante as $id){
            $id_m=$id->id;
        }
        if($proveedor==""){
            $alta_mantenimiento=new AltaMantenimiento($request->all());
            $alta_mantenimiento->mantenimiento_id=$id_m;
            $alta_mantenimiento->proveedor_id=1;
            $alta_mantenimiento->ordentrabajo_id=$orden_trabajo;
            $alta_mantenimiento->interno=$interno;
            $alta_mantenimiento->costo=$costo;
            $alta_mantenimiento->descripcion=$descripcion;
            $alta_mantenimiento->observacion=$observacion;
            $alta_mantenimiento->estado=1;
            $alta_mantenimiento->save();
        }
        else{
            $alta_mantenimiento=new AltaMantenimiento($request->all());
            $alta_mantenimiento->mantenimiento_id=$id_m;
            $alta_mantenimiento->proveedor_id=$proveedor;
            $alta_mantenimiento->ordentrabajo_id=$orden_trabajo;
            $alta_mantenimiento->costo=$costo;
            $alta_mantenimiento->descripcion=$descripcion;
            $alta_mantenimiento->observacion=$observacion;
            $alta_mantenimiento->estado=1;
            $alta_mantenimiento->save();
        }
        return response()->json(["mensaje"=>$detalle]);
    }

}
