<?php

namespace App\Http\Controllers;

use App\AsignarMaquinaria;
use App\Http\Requests\CrearUsoMaquinariaRequest;
use App\UsoMaquinaria;
use Illuminate\Http\Request;
use Auth;
use DB;
use Yajra\Datatables\Facades\Datatables;
Use Hashids;

class OperarioController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('operario');

    }
    public function index()
    {
        /*
         * SELECT f.fabricante,f.marca,f.modelo,f.descripcion,f.serie,f.fechacompra,f.path FROM asignar_maquinarias AS a
            INNER JOIN personas AS p ON a.persona_id = p.id
            INNER JOIN users AS u ON p.user_id = u.id
            INNER JOIN ficha_tecnicas AS f ON a.fichatecnica_id = f.id
            WHERE u.id=2

         */
        $user_id=Auth::user()->id;

        $asignados=AsignarMaquinaria::select(DB::raw('ficha_tecnicas.fabricante,ficha_tecnicas.marca,ficha_tecnicas.modelo,ficha_tecnicas.descripcion,ficha_tecnicas.serie,ficha_tecnicas.fechacompra,ficha_tecnicas.path'))
            ->join('personas','personas.id','=','asignar_maquinarias.persona_id')
            ->join('users','users.id','=','personas.user_id')
            ->join('ficha_tecnicas','ficha_tecnicas.id','=','asignar_maquinarias.fichatecnica_id')
            ->where('users.id','=',$user_id)
            ->get();

        return view('operario.asignado',compact('asignados'));
    }
    public function reporteUso(){
        return view('usomanquinaria.index');
    }
    public function calendario(){
        return view('operario.calendario');
    }

    public function eventos(){
        /*
         * SELECT c.titulo,c.fecha_final,c.todoeldia,c.color,c.descripcion,c.id  FROM asignar_maquinarias AS a
            INNER JOIN personas AS p ON a.persona_id = p.id
            INNER JOIN users AS u ON p.user_id = u.id
            INNER JOIN ficha_tecnicas AS f ON a.fichatecnica_id = f.id
            INNER JOIN mantenimientos AS m ON f.id = m.fichatecnica_id
            INNER JOIN calendarios AS c ON m.id = c.mantenimiento_id
            WHERE u.id=2
         */
        $user_id=Auth::user()->id;
        $calendarios=AsignarMaquinaria::select(DB::raw('calendarios.titulo,calendarios.fecha_final,calendarios.todoeldia,calendarios.color,calendarios.descripcion,calendarios.id'))
            ->join('personas','personas.id','=','asignar_maquinarias.persona_id')
            ->join('users','users.id','=','personas.user_id')
            ->join('ficha_tecnicas','ficha_tecnicas.id','=','asignar_maquinarias.fichatecnica_id')
            ->join('mantenimientos','mantenimientos.fichatecnica_id','=','ficha_tecnicas.id')
            ->join('calendarios','calendarios.mantenimiento_id','=','mantenimientos.id')
            ->where('users.id','=',$user_id)
            ->get();
        $data = array();
        $i=0;
        foreach($calendarios as $calendario){
            $data[$i] = array(
                "title"=>$calendario->titulo,
                "start"=>$calendario->fecha_final,
                "end"=>$calendario->fecha_final,
                "allDay"=>$calendario->todoeldia,
                "color"=>$calendario->color,
                "description"=>$calendario->descripcion,
                "id"=>$calendario->id

            );
            $i++;
        }
        json_encode($data);
        return $data;

    }

    public function getReportes(){
        /*
         *  SELECT  uso_maquinarias.detalle,uso_maquinarias.fecha,uso_maquinarias.hora_Inicial,uso_maquinarias.hora_Final,uso_maquinarias.inicial_horometro,uso_maquinarias.final_horometro
            FROM asignar_maquinarias AS a
            INNER JOIN personas AS p ON a.persona_id = p.id
            INNER JOIN users AS u ON p.user_id = u.id
            INNER JOIN ficha_tecnicas AS f ON a.fichatecnica_id = f.id
            INNER JOIN uso_maquinarias  ON f.id = uso_maquinarias.fichatecnica_id
            WHERE u.id=2
         */
        $user_id=Auth::user()->id;
        $usomaquinarias=AsignarMaquinaria::select(DB::raw('uso_maquinarias.id,uso_maquinarias.detalle,uso_maquinarias.created_at,uso_maquinarias.hora_Inicial,uso_maquinarias.hora_Final,uso_maquinarias.inicial_horometro,uso_maquinarias.final_horometro'))
            ->join('personas','personas.id','=','asignar_maquinarias.persona_id')
            ->join('users','users.id','=','personas.user_id')
            ->join('ficha_tecnicas','ficha_tecnicas.id','=','asignar_maquinarias.fichatecnica_id')
            ->join('uso_maquinarias','uso_maquinarias.fichatecnica_id','=','ficha_tecnicas.id')
            ->where('users.id','=',$user_id)
            ->get();
        return Datatables::of($usomaquinarias)->addColumn('action', function ($uso_maquinaria) {
            $encriptado=Hashids::encode($uso_maquinaria->id);
            return "<div class='btn-group'>
            <button value=".$encriptado." OnClick='Ver(this);' data-toggle='modal' data-target='#myModal5'  class='btn btn-info' ><i class='md  md-remove-red-eye'></i></button>
            
             <div>";
        })->make(true);

    }

    public function edit($id)
    {
        $desencriptando = Hashids::decode($id);
        $contar=count($desencriptando);
        if($contar==0){
            return view('errors.500');
        }else {
            $desencriptando = Hashids::decode($id)[0];
            $uso = UsoMaquinaria::find($desencriptando);
            return response()->json($uso);
        }
    }
    public function store(CrearUsoMaquinariaRequest $request)
    {
        $user_id=Auth::user()->id;

        $id_ficha=AsignarMaquinaria::select(DB::raw('ficha_tecnicas.id'))
            ->join('personas','personas.id','=','asignar_maquinarias.persona_id')
            ->join('users','users.id','=','personas.user_id')
            ->join('ficha_tecnicas','ficha_tecnicas.id','=','asignar_maquinarias.fichatecnica_id')
            ->where('users.id','=',$user_id)
            ->get();
        $id_m='';

        foreach($id_ficha as $id){
            $id_m=$id->id;
        }

        $usomaquina=new UsoMaquinaria($request->all());
        $usomaquina->fichatecnica_id=$id_m;
        $usomaquina->estado=1;
        $usomaquina->save();

        $detalle=$request->input('detalle');
        return response()->json(["mensaje"=>$detalle]);

    }
}
