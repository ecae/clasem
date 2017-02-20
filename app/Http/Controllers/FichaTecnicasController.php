<?php

namespace App\Http\Controllers;

use App\FichaTecnica;
use App\Http\Requests\CrearEquiposRequest;
use App\Http\Requests\UpdateEquiposRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
use Yajra\Datatables\Facades\Datatables;
Use Hashids;
class FichaTecnicasController extends Controller
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
        return view('equipos.index');
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
    public function getEquipos(){
        $equipos=FichaTecnica::select('id','fabricante','marca','modelo','descripcion')->get();
        return Datatables::of($equipos)->addColumn('action', function ($equipo) {
            $encriptado=Hashids::encode($equipo->id);
            return "<div class='btn-group'>
            <button value=".$encriptado." OnClick='Ver(this);' data-toggle='modal' data-target='#myModal5'  class='btn btn-info' ><i class='md  md-remove-red-eye'></i></button>
            <button value=".$encriptado." OnClick='Mostrar(this);'  data-toggle='modal' data-target='#myModal2' class='btn btn-primary '><i class=' ion-edit'></i></button>
            <button value=".$encriptado." OnClick='Eliminar(this);' data-toggle='modal' data-target='#myModal9' class='btn btn-danger '><i class=' ion-trash-a'></i></button>
             <div>";
        })
            ->editColumn('id', function($equipos) {
                $conca='MQ'.str_pad($equipos->id, 4, "0", STR_PAD_LEFT);
                return $conca;
            })
            ->make(true);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearEquiposRequest $request)
    {
        $maquinaria=new FichaTecnica($request->all());
        $maquinaria->save();
        return response()->json(["mensaje"=>$request->input('modelo')]);

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
            $maquina = FichaTecnica::find($desencriptando);
            return response()->json($maquina);
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
        /*
        $fechacompra=$request->input('fechacompra');
        $format = str_replace('/', '-', $fechacompra);
        $Nfechacompra= date('Y-m-d', strtotime($format));

        $maquina=FichaTecnica::find($id);
        $maquina->fill($request->all());
        $maquina->fechacompra= $Nfechacompra;
        $maquina->save();
        return response()->json(["mensaje"=>$request->input('modelo')]);
        */
        dd($request->all());

    }
    public function update2(UpdateEquiposRequest $request,$id)
    {

        //$fechacompra=$request->input('fechacompra');
        //$format = str_replace('/', '-', $fechacompra);
        //$Nfechacompra= date('Y-m-d', strtotime($format));

        $desencriptando = Hashids::decode($id);
        $contar=count($desencriptando);
        if($contar==0){
            return view('errors.500');
        }else {
            $desencriptando = Hashids::decode($id)[0];
            $maquina = FichaTecnica::find($desencriptando);
            $maquina->fill($request->all());
            $maquina->save();
            return response()->json(["mensaje" => $request->input('modelo')]);
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
            FichaTecnica::destroy($desencriptando);
            return response()->json(["mensaje" => "exitosamente"]);
        }
    }
}
