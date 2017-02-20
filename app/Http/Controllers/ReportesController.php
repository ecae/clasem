<?php

namespace App\Http\Controllers;

use App\AltaMantenimiento;
use App\AsignarMaquinaria;
use App\OrdenTrabajo;
use Illuminate\Http\Request;
use Hashids;
use DB;
class ReportesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function ImprimirOrdenTrabajo($id){
        $desencriptando = Hashids::decode($id);
        $contar=count($desencriptando);
        if($contar==0){
            return view('errors.500');
        }else {
            $desencriptando = Hashids::decode($id)[0];
            $ordenTrabajos = OrdenTrabajo::select()->where('id', '=', $desencriptando)->get();
            return view('reportesPDF.ReporteOrdenTrabajo', compact('ordenTrabajos'));
        }

    }
    public function ImprimirMantenimiento($id){
        $desencriptando = Hashids::decode($id);
        $contar=count($desencriptando);
        if($contar==0){
            return view('errors.500');
        }else {
            $desencriptando = Hashids::decode($id)[0];
            $altaMantenimientos = AltaMantenimiento::select(DB::raw('alta_mantenimientos.id,orden_trabajos.nombre_maquinaria,orden_trabajos.marca_maquinaria,orden_trabajos.modelo_maquinaria,orden_trabajos.serie_maquinaria,orden_trabajos.kilometraje,orden_trabajos.horometro,orden_trabajos.tipo_mtto,alta_mantenimientos.descripcion,alta_mantenimientos.observacion'))
                ->join('orden_trabajos', 'orden_trabajos.id', '=', 'alta_mantenimientos.ordentrabajo_id')
                ->where('alta_mantenimientos.id', '=', $desencriptando)->get();

            return view('reportesPDF.ReporteMantenimiento', compact('altaMantenimientos'));
        }
    }
    public function DescargarCertificado($id){
        $desencriptando = Hashids::decode($id);
        $contar=count($desencriptando);
        if($contar==0){
            return view('errors.500');
        }else{
            $desencriptando = Hashids::decode($id)[0];
        //$certificado= public_path(). "file/ordentrabajo/";
        //return response()->download($certificado);
            $paths=AltaMantenimiento::select('path')->where('id','=',$desencriptando)->get();
            $path2='';
            foreach ($paths as $path){
                $path2=$path->path;
            }
            $certificado= public_path(). "/file/ordentrabajo/".$path2;
            return response()->download($certificado);
        }
    }
}
