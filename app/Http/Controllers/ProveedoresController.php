<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrearProveedorRequest;
use App\Proveedor;
use Illuminate\Http\Request;
Use DB;

use Yajra\Datatables\Facades\Datatables;
Use Hashids;
class ProveedoresController extends Controller
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
        return view('proveedor.index');
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
    public function store(CrearProveedorRequest $request)
    {
        $proveedor=new Proveedor($request->all());
        $proveedor->save();
        $razonsocial=$request->input('razonsocial');
        return response()->json(["mensaje"=>$razonsocial]);
    }
    public function getProveedores(){
        $proveedores=Proveedor::select(['id','ruc','razonsocial','descripcion'])
            ->where('id','<>',1)
            ->get();
        return Datatables::of($proveedores)->addColumn('action', function ($proveedor) {
            $encriptado=Hashids::encode($proveedor->id);
            return "<div class='btn-group'>
            <button value=".$encriptado." OnClick='Ver(this);' data-toggle='modal' data-target='#myModal5'  class='btn btn-info' ><i class='md  md-remove-red-eye'></i></button>
            <button value=".$encriptado." OnClick='Mostrar(this);'  data-toggle='modal' data-target='#myModal2' class='btn btn-primary '><i class=' ion-edit'></i></button>
            <button value=".$encriptado." OnClick='Eliminar(this);' data-toggle='modal' data-target='#myModal9' class='btn btn-danger '><i class=' ion-trash-a'></i></button>
             <div>";
        })
            ->editColumn('id', function($proveedores) {
                $conca='PR'.str_pad($proveedores->id, 4, "0", STR_PAD_LEFT);
                return $conca;
            })
            ->make(true);
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
            $proveedor = Proveedor::find($desencriptando);
            return response()->json($proveedor);
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
            $proveedor = Proveedor::find($desencriptando);
            $proveedor->fill($request->all());
            $proveedor->save();
            $razonsocial = $request->input('razonsocial');
            return response()->json(["mensaje" => $razonsocial]);
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
            Proveedor::destroy($desencriptando);
            return response()->json(["mensaje" => "exitosamente"]);
        }
    }
}
