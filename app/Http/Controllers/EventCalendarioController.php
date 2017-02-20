<?php

namespace App\Http\Controllers;

use App\AsignarMaquinaria;
use App\Calendario;
use App\FichaTecnica;
use App\Mail\AlertaEmail;
use App\Mantenimiento;
use App\OrdenTrabajo;
use App\Persona;
use App\UsoMaquinaria;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Mail;

class EventCalendarioController extends Controller
{
    public function __construct(){
        $this->middleware('auth');

    }

    public function index()
    {
        return view('calendario.index');
    }

    public function getNequipo($id){



    }
    public function prueba()
    {
        /*
         *SELECT (m.detalle)mantenimiento,(e.descripcion)equipo,(u.detalle)uso,(u.final_horometro),m.limite_horometro,m.fecha_inicial FROM mantenimientos AS m
            INNER  JOIN ficha_tecnicas AS e ON m.fichatecnica_id = e.id
            INNER JOIN uso_maquinarias AS u ON e.id = u.fichatecnica_id
            ORDER BY u.final_horometro DESC LIMIT 6
         */

        /*
        $id = Mantenimiento::all()->pluck('id');
        $count = count($id);

        $mantenimientos=Mantenimiento::select(DB::raw('mantenimientos.id,(mantenimientos.detalle)AS mantenimiento,(ficha_tecnicas.descripcion)AS equipo,(uso_maquinarias.final_horometro),mantenimientos.limite_horometro,mantenimientos.fecha_inicial'))
            ->join('ficha_tecnicas','ficha_tecnicas.id','=','mantenimientos.fichatecnica_id')
            ->join('uso_maquinarias','uso_maquinarias.fichatecnica_id','=','ficha_tecnicas.id')
            ->orderby('uso_maquinarias.final_horometro','DESC')->take($count)->get();

        return response()->json($mantenimientos);*/
        //$fecha=date('Y-m-d');
        //dd($fecha);
        /*
         * SELECT  u1.fichatecnica_id,u1.final_horometro
            FROM uso_maquinarias AS u1
            LEFT JOIN uso_maquinarias AS u2
              ON u1.fichatecnica_id=u2.fichatecnica_id AND u1.final_horometro<u2.final_horometro
            WHERE u2.final_horometro is NULL
         */
        /*
        $sub=Mantenimiento::select(DB::raw('mantenimientos.id,(mantenimientos.detalle)AS mantenimiento,(ficha_tecnicas.descripcion)AS equipo,(uso_maquinarias.detalle)AS uso,(uso_maquinarias.final_horometro),mantenimientos.limite_horometro,mantenimientos.fecha_mantenimiento'))
            ->join('ficha_tecnicas','ficha_tecnicas.id','=','mantenimientos.fichatecnica_id')
            ->join('uso_maquinarias','uso_maquinarias.fichatecnica_id','=','ficha_tecnicas.id');
        */
        /*
        $count = DB::table( DB::raw("({$sub->toSql()}) as sub") )
            ->mergeBindings($sub->getQuery()) // you need to get underlying Query Builder

            ->get();
        */


        //LO PRINCIPAL


        //return view('emails.index');
        //$id=100;
        //$conca='OT'.str_pad($id, 4, "0", STR_PAD_LEFT);
        $ordenes= array();
        $ordentrabajos=OrdenTrabajo::Select('id')->where('estado','=',1)->get();
        $i=0;
        foreach ($ordentrabajos as $ordentrabajo){
            $conca='OT'.str_pad($ordentrabajo->id, 4, "0", STR_PAD_LEFT);
            $ordenes[$i] = array(
                    "id"=>$ordentrabajo->id,
                    "orden"=>$conca
                );
            $i++;
        }
        json_encode($ordenes);

        $collection = collect($ordenes);
        dd($collection);
    }

    public function eventos(){
        $data = array();
        $id = Calendario::all()->pluck('id');
        $titulo = Calendario::all()->pluck('titulo');
        $fechaIni = Calendario::all()->pluck('fecha_final');
        $fechaFin = Calendario::all()->pluck('fecha_final');
        $allDay = Calendario::all()->pluck('todoeldia');
        $color = Calendario::all()->pluck('color');
        $estado = Calendario::all()->pluck('estado');
        $descripcion = Calendario::all()->pluck('descripcion');

        $count = count($id);
        for($i=0;$i<$count;$i++){
            if($estado[$i]==1){
                $data[$i] = array(
                    "title"=>$titulo[$i],
                    "start"=>$fechaIni[$i],
                    "end"=>$fechaFin[$i],
                    "allDay"=>$allDay[$i],
                    "color"=>$color[$i],
                    "description"=>$descripcion[$i],
                    "id"=>$id[$i]
                );
            }
        }

        json_encode($data);
        return $data;
    }

    public function enviarCorreo(Request $request){

        Mail::to($request->destino)->send(new AlertaEmail($request->mensaje,$request->asunto));
    }

    public function prueba2(){
        /*
         *
            SELECT (m.detalle)mantenimiento,(f.descripcion)equipo,u.final_horometro,m.limite_horometro,m.fecha_mantenimiento,concat(p.nombre,' ',p.apellidoPat,' ',p.apellidoMat)ncompletos,p.email FROM mantenimientos AS m
            INNER JOIN ficha_tecnicas AS f ON m.fichatecnica_id = f.id
            INNER JOIN uso_maquinarias AS u ON f.id = u.fichatecnica_id
            INNER JOIN asignar_maquinarias AS a ON f.id = a.fichatecnica_id
            INNER JOIN personas AS p ON a.persona_id = p.id
            WHERE   u.final_horometro IN (6000,10000) AND m.estado=1;
         */
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

        $mantenimientos=Mantenimiento::select(DB::raw("mantenimientos.id,(mantenimientos.detalle)AS mantenimiento,(f.descripcion)AS equipo,(u.detalle)AS uso,(u.final_horometro),mantenimientos.limite_horometro,mantenimientos.fecha_mantenimiento,concat(p.nombre,' ',p.apellidoPat,' ',p.apellidoMat)ncompletos,p.email"))
            ->join('ficha_tecnicas as f','f.id','=','mantenimientos.fichatecnica_id')
            ->join('uso_maquinarias as u','u.fichatecnica_id','=','f.id')
            ->join('asignar_maquinarias as a','a.fichatecnica_id','=','f.id')
            ->join('personas as p','p.id','=','a.persona_id')
            ->whereIn('u.final_horometro', $array)
            ->where('mantenimientos.estado','=',1)
            ->get();

        return response()->json($mantenimientos);

    }
}
