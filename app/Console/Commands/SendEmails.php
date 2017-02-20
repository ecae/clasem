<?php

namespace App\Console\Commands;

use App\Mantenimiento;
use App\UsoMaquinaria;
use Illuminate\Console\Command;
use DB;
use App\Mail\AlertaEmail;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envio de correo de alerta';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
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
        $fecha_actual=date('Y-m-d');
        foreach ($mantenimientos as $mantenimiento){
            if($mantenimiento->fecha_mantenimiento==''){
                if ($mantenimiento->limite_horometro<=$mantenimiento->final_horometro){
                    //$mensaje="ESTIMAD@ ".$mantenimiento->ncompleos." la maquinaria ".$mantenimiento->equipo." necesita hacerle un mantenimiento de ".$mantenimiento->mantenimiento." porfavor realizarlo lo mas antes posible";
                    $titulo="MAQUINARIA: ".$mantenimiento->equipo;
                    $limite="Aver superado el Limite del  Horometro, ".$mantenimiento->limite_horometro."km para dicho mantenimiento.";
                    Mail::to($mantenimiento->email)->send(new AlertaEmail($titulo,$mantenimiento->ncompletos,$mantenimiento->equipo,$mantenimiento->mantenimiento,$limite));

                }else{

                }
            }
            else{
                if($mantenimiento->fecha_mantenimiento<=$fecha_actual){
                    //$mensaje="ESTIMAD@ ".$mantenimiento->ncompleos." la maquinaria: ".$mantenimiento->equipo.", necesita hacerle un mantenimiento de ".$mantenimiento->mantenimiento.", porfavor realizar el mantenimiento lo antes posible";
                    $titulo="MANTENIMIENTO: ".$mantenimiento->equipo;
                    $limite="Haberse cumplido con la Fecha,".$mantenimiento->fecha_mantenimiento." programada.";
                    Mail::to($mantenimiento->email)->send(new AlertaEmail($titulo,$mantenimiento->ncompletos,$mantenimiento->equipo,$mantenimiento->mantenimiento,$limite));
                }
                else{

                }
            }
        }

        $this->info("LAS ALERTAS SE ENVIARON CORRECTAMENTE");
    }
}
