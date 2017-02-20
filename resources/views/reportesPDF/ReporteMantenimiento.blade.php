<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reporte Mantenimiento</title>
    <link rel="stylesheet" type="text/css" href="{{asset('tema1/css/Mantenimiento.css')}}">
</head>
<body>
<div class="contenedor">
 @foreach($altaMantenimientos as $altaMantenimiento)
    <div class="cabezera bordeado">
        <div class="logo bordeado">
            <div class="logo1">
                <span > CLASEM</span>
            </div>
            <div class="logo2">
                <span class="eom"> EOM </span>
            </div>
        </div>
        <div class="titulos bordeado">
            <div class="titulo1">
                <span>EQUIPOS Y MAQUINARIAS</span>
            </div>
            <div class="titulo2">
                <span>REPORTE DE MANTENIMIENTO</span>
            </div>
        </div>
        <div class="paginacion">
            <div class="bordeado pag-1">
                EQM.001‐F02
            </div>
            <div class=" pag-2">
                <div class="bordeado fect-1">
                    Ver: 00
                </div>
                <div class="bordeado fect-2">
                    F:11/12/12
                </div>
            </div>
            <div class="bordeado pag-3">
                Página: 1 de 1
            </div>
        </div>
    </div>
    <div class="separador-blanco bordeado"></div>
    <div class="informacion-reporte bordeado">
        <div class="infor-1 bordeado">
            <div class="fecha " style="border-top: 0px"><span class="margen-left">Fecha del Reporte</span></div>
            <div class="mantenimiento "><span class="margen-left">Mantenimiento</span></div>
            <div class="obra"><span class="margen-left">Obra</span></div>
        </div>
        <div class="infor-2 bordeado">
            <div class="vacio1" style="border-top: 0px"><span class="margen-left"></span></div>
            <div class="mantenimiento-clase ">
                <div class="orden-1"><span class="margen-left">Preventivo</span> </div>
                @if($altaMantenimiento->tipo_mtto=='Preventivo')
                    <div class="orden-2"><span class="margen-left">X</span></div>
                @else
                    <div class="orden-2"><span class="margen-left"></span></div>
                @endif
                <div class="orden-3"><span class="margen-left">Correctivo</span> </div>
                @if($altaMantenimiento->tipo_mtto=='Correctivo')
                    <div class="orden-4"><span class="margen-left">X</span></div>
                @else
                    <div class="orden-4"></div>
                @endif

            </div>
            <div class="vacio2"><span class="margen-left">SANTA MARGARITA DE PIURA II</span></div>
        </div>
    </div>
    <div class="separador-blanco2 bordeado"><span class="margen-left">Equipo / Maquinaria</span></div>
    <div class="informacion-maquinaria bordeado">
        <div class="infor-1 bordeado">
            <div class="nombre"><span class="margen-left">Nombre de la Maquina</span></div>
            <div class="modelo"><span class="margen-left">Modelo</span></div>
            <div class="serie"><span class="margen-left">Serie / Placa</span></div>
            <div class="otras"><span class="margen-left">Otras especificaciones</span></div>
        </div>
        <div class="infor-2 bordeado">
            <div class="completar-1"><span class="margen-left">{{$altaMantenimiento->nombre_maquinaria}} </span> </div>
            <div class="completar-2">
                <div class="completar2-1 "><span class="margen-left">{{$altaMantenimiento->modelo_maquinaria}} </span></div>
                <div class="completar2-2 "><span class="margen-left">Kilometraje</span></div>
                <div class="completar2-3 "><span class="margen-left">{{$altaMantenimiento->kilometraje}} </span></div>
            </div>
            <div class="completar-3">
                <div class="completar2-1 "><span class="margen-left">{{$altaMantenimiento->serie_maquinaria}} </span></div>
                <div class="completar2-2 "><span class="margen-left">Horometro</span></div>
                <div class="completar2-3 "><span class="margen-left">{{$altaMantenimiento->horometro}} </span></div>
            </div>
            <div class="completar-4"><span class="margen-left"></span> </div>
        </div>

    </div>
    <div class="separador-blanco2 bordeado"><span class="margen-left">Descripción de la actividad realizada</span></div>
    <div class="actividad bordeado"><span class="margen-left">{{$altaMantenimiento->descripcion}} </span></div>
    <div class="separador-blanco2 bordeado"><span class="margen-left">Recomendaciones</span></div>
    <div class="recomendaciones bordeado"><span class="margen-left">{{$altaMantenimiento->observacion}}</span></div>
    <div class="firma bordeado">
        <div class="firma-1">
            <div class="firma1-1 "></div>
            <div class="firma2-1">Resp. del Mantenimiento</div>
        </div>
        <div class="firma-1">
            <div class="firma1-1 "></div>
            <div class="firma2-1">V°B° del Supervisor</div>
        </div>
    </div>
 @endforeach
</div>
</body>
</html>