<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clasem EOM</title>
    <link rel="stylesheet" href="{{ asset('tema1/css/OrdenTrabajo.css') }}"  />
</head>
<body>
<div class="contenedor">
  @foreach($ordenTrabajos as $ordenTrabajo)
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
                <span>ORDEN DE TRABAJO</span>
            </div>
        </div>
        <div class="paginacion">
            <div class="bordeado pag-1">
                EQM.001‐F02
            </div>
            <div class="bordeado pag-2">
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
    <div class="informacion bordeado">
        <div class="bordeado div-1">
            <div class="contenido-informacion" style="border-bottom: 1px solid black">
                Maquinaria:
            </div>
            <div class="contenido-informacion" style="border-top: 1px solid black" >
                Modelo:
            </div>
        </div>
        <div class="bordeado div-2">
            <div class="enblanco" style="border-bottom: 1px solid black">{{$ordenTrabajo->nombre_maquinaria}}</div>
            <div class="enblanco" style="border-top: 1px solid black">{{$ordenTrabajo->modelo_maquinaria}}</div>
        </div>
        <div class="bordeado div-3">
            <div class="contenido-informacion" style="border-bottom: 1px solid black">
                Marca:
            </div>
            <div class="contenido-informacion" style="border-top: 1px solid black">
                Ubicación:
            </div>
        </div>
        <div class="bordeado div-4">
            <div class="enblanco" style="border-bottom: 1px solid black">{{$ordenTrabajo->marca_maquinaria}}</div>
            <div class="enblanco" style="border-top: 1px solid black">Piura</div>
        </div>
        <div class="bordeado div-5">
            <div class="contenido-informacion" style="border-bottom: 1px solid black">
                Código:
            </div>
            <div class="contenido-informacion" style="border-top: 1px solid black">
                Serie:
            </div>
        </div>
        <div class="bordeado div-6">
            <div class="enblanco" style="border-bottom: 1px solid black"></div>
            <div class="enblanco" style="border-top: 1px solid black">{{$ordenTrabajo->serie_maquinaria}}</div>
        </div>
        <div class="bordeado div-7">
            <div class="contenido-informacion" style="border-bottom: 1px solid black">
                Kilometraje:
            </div>
            <div class="contenido-informacion" style="border-top: 1px solid black">
                Horometro:
            </div>
        </div>
        <div class="bordeado div-8">
            <div class="enblanco" style="border-bottom: 1px solid black">{{$ordenTrabajo->kilometraje}}</div>
            <div class="enblanco" style="border-top: 1px solid black">{{$ordenTrabajo->horometro}}</div>
        </div>
    </div>
    <div class="bordeado encabezado2" style="border-top: 0px">
        <div class="bordeado fecha enca-1">Fecha</div>
        <div class="bordeado enca-2" >
            <div class="loca-averia" style="border-bottom: 1px solid black">
                Localización Avería
            </div>
            <div class="loca-averia2" style="border-top: 0px solid black">
                <div class="bordeado letras-1">
                    A
                </div>
                <div class="bordeado letras-1">
                    B
                </div>
                <div class="bordeado letras-1">
                    C
                </div>
                <div class="bordeado letras-1">
                    D
                </div>
                <div class="bordeado letras-1">
                    E
                </div>
                <div class="bordeado letras-1" style="border-right: 0px">
                    F
                </div>
            </div>
        </div>
        <div class="bordeado enca-3">
            <div class="orden" style="border-bottom: 0px solid black">
                Orden N°
            </div>
        </div>
        <div class="bordeado enca-4">
            <div class="tipomtto" style="border-bottom: 1px solid black">
                Tipo MTTO
            </div>
            <div class="tipomtto2" style="border-top: 0px solid black">
                <div class="bordeado numeros-1">1</div>
                <div class="bordeado numeros-2">2</div>
                <div class="bordeado numeros-3">3</div>
                <div class="bordeado numeros-4">4</div>
            </div>
        </div>
        <div class="bordeado descriptrabajo enca-5">
            Descripción del Trabajo
        </div>
        <div class="bordeado enca-6">
            <div class=" duraciontarea">Duración de tarea</div>
            <div class=" cantidadpersonal">Cantidad Personal</div>
        </div>
        <div class="bordeado enca-7">
            <div class=" codigo">Código Material</div>
            <div class=" cantidad">Cantidad</div>
        </div>
    </div>
    <div class="contenido bordeado">
        <div class="bordeado row">
            <!-- FECHA-->
            <div class="bordeado row-1" style="border-top: 0px;border-left: 0px"> {{$ordenTrabajo->fecha}}</div>
            <!-- TIPO MANTENIMIENTO-->
            <div class="row-2">
                    @if($ordenTrabajo->localizacion_averia=='Mecanico')
                        <div class="bordeado letras2-1">X</div>
                    @else
                        <div class="bordeado letras2-1"></div>
                    @endif
                    @if($ordenTrabajo->localizacion_averia=='Electrico')
                        <div class="bordeado letras2-1">X</div>
                    @else
                        <div class="bordeado letras2-1"></div>
                    @endif
                    @if($ordenTrabajo->localizacion_averia=='Electronico')
                        <div class="bordeado letras2-1">X</div>
                    @else
                        <div class="bordeado letras2-1"></div>
                    @endif
                    @if($ordenTrabajo->localizacion_averia=='Neumatico')
                        <div class="bordeado letras2-1">X</div>
                    @else
                        <div class="bordeado letras2-1"></div>
                    @endif
                    @if($ordenTrabajo->localizacion_averia=='Hidraulico')
                        <div class="bordeado letras2-1">X</div>
                    @else
                        <div class="bordeado letras2-1"></div>
                    @endif
                    @if($ordenTrabajo->localizacion_averia=='Otros')
                        <div class="bordeado letras2-1">X</div>
                    @else
                        <div class="bordeado letras2-1"></div>
                    @endif
            </div>
            <div class="bordeado row-3" style="border-top: 0px"></div>
            <!-- TIPO MANTENIMIENTO-->
            <div class="row-4" >
                    @if($ordenTrabajo->tipo_mtto=='Preventivo')
                        <div class="bordeado numeros2-1">X</div>
                    @else
                        <div class="bordeado numeros2-1"></div>
                    @endif
                    @if($ordenTrabajo->tipo_mtto=='Correctivo')
                        <div class="bordeado numeros2-1">X</div>
                    @else
                        <div class="bordeado numeros2-1"></div>
                    @endif
                        <div class="bordeado numeros2-1"></div>
                        <div class="bordeado numeros2-1"></div>
            </div>
            <!-- DESCRIPCION TRABAJO-->
            <div class="bordeado row-5" style="border-top: 0px"></div>
            <div class="bordeado row-6" style="border-top: 0px">
                <!-- DURACION TAREA-->
                <div class=" duraciontarea"></div>
                <!-- CONTIDAD PERSONAL-->
                <div class=" cantidadpersonal"></div>
            </div>
            <div class="bordeado row-7" style="border-top: 0px">
                <!-- CODIGO MATERIAL-->
                <div class="duraciontareaRow" style="border-right: 1px solid black"></div>
                <!-- CANTIDAD-->
                <div class="cantidadpersonalRow" style="border-left: 1px solid black"></div>
            </div>
        </div>
        <!-- LOOP-->
        <?php
        $arrayDescripcionTrabajo=explode('-',$ordenTrabajo->descripcion_trabajo);
        $arrayDuracionTarea=explode('-',$ordenTrabajo->duracion_tarea);
        $arrayCantidadPersonal=explode('-',$ordenTrabajo->cant_personal);
        $arrayCodigoMaterial=explode('-',$ordenTrabajo->cod_material);
        $arrayCantidad=explode('-',$ordenTrabajo->cantidad);
        $tamaño=count($arrayDescripcionTrabajo);
        $relleno=14;
        $relleno=$relleno-$tamaño;
        for($i=0;$i<$tamaño;$i++){
            $cantidadCaracteres=strlen($arrayDescripcionTrabajo[$i]);
          if ($cantidadCaracteres>35){
                       $relleno=$relleno-1;
              echo "<div class='bordeado row' style='border-top: 0px'>
                    <div class='bordeado row-1' style='border-top: 0px;border-left: 0px'></div>".
                  "<div class='row-2'>
                        <div class='bordeado letras2-1'></div>
                        <div class='bordeado letras2-1'></div>
                        <div class='bordeado letras2-1'></div>
                        <div class='bordeado letras2-1'></div>
                        <div class='bordeado letras2-1'></div>
                        <div class='bordeado letras2-1'></div>
                    </div>".
                  "<div class='bordeado row-3' style='border-top: 0px'></div>
                    <div class='row-4' >
                        <div class='bordeado numeros2-1'></div>
                        <div class='bordeado numeros2-2'></div>
                        <div class='bordeado numeros2-3'></div>
                        <div class='bordeado numeros2-4'></div>
                    </div>".
                  "<div class='bordeado row-5' style='border-top: 0px'>".$arrayDescripcionTrabajo[$i]."</div>".
                  "<div class='bordeado row-6' style='border-top: 0px'>
                        <div class='duraciontarea'>".$arrayDuracionTarea[$i]."</div>".
                  "<div class='cantidadpersonal'>".$arrayCantidadPersonal[$i]."</div>".
                  "</div>".
                  "<div class='bordeado row-7' style='border-top: 0px'>".
                  "<div class='duraciontareaRow' style='border-right: 1px solid black'>".$arrayCodigoMaterial[$i]."</div>".
                  "<div class='cantidadpersonalRow' style='border-left: 1px solid black'>".$arrayCantidad[$i]."</div>".
                  "</div>".
                  "</div>".
                "<div class='bordeado row' style='border-top: 0px'>
                    <div class='bordeado row-1' style='border-top: 0px;border-left: 0px'></div>".
                  "<div class='row-2'>
                        <div class='bordeado letras2-1'></div>
                        <div class='bordeado letras2-1'></div>
                        <div class='bordeado letras2-1'></div>
                        <div class='bordeado letras2-1'></div>
                        <div class='bordeado letras2-1'></div>
                        <div class='bordeado letras2-1'></div>
                    </div>".
                  "<div class='bordeado row-3' style='border-top: 0px'></div>
                    <div class='row-4' >
                        <div class='bordeado numeros2-1'></div>
                        <div class='bordeado numeros2-2'></div>
                        <div class='bordeado numeros2-3'></div>
                        <div class='bordeado numeros2-4'></div>
                    </div>".
                  "<div class='bordeado row-5' style='border-top: 0px'>"."</div>".
                  "<div class='bordeado row-6' style='border-top: 0px'>
                        <div class='duraciontarea'>"."</div>".
                  "<div class='cantidadpersonal'></div>".
                  "</div>".
                  "<div class='bordeado row-7' style='border-top: 0px'>".
                  "<div class='duraciontareaRow' style='border-right: 1px solid black'>"."</div>".
                  "<div class='cantidadpersonalRow' style='border-left: 1px solid black'>"."</div>".
                  "</div>".
                  "</div>";
          }else{
              echo "<div class='bordeado row' style='border-top: 0px'>
                    <div class='bordeado row-1' style='border-top: 0px;border-left: 0px'></div>".
                  "<div class='row-2'>
                        <div class='bordeado letras2-1'></div>
                        <div class='bordeado letras2-1'></div>
                        <div class='bordeado letras2-1'></div>
                        <div class='bordeado letras2-1'></div>
                        <div class='bordeado letras2-1'></div>
                        <div class='bordeado letras2-1'></div>
                    </div>".
                  "<div class='bordeado row-3' style='border-top: 0px'></div>
                    <div class='row-4' >
                        <div class='bordeado numeros2-1'></div>
                        <div class='bordeado numeros2-2'></div>
                        <div class='bordeado numeros2-3'></div>
                        <div class='bordeado numeros2-4'></div>
                    </div>".
                  "<div class='bordeado row-5' style='border-top: 0px'>".$arrayDescripcionTrabajo[$i]."</div>".
                  "<div class='bordeado normal row-6' style='border-top: 0px'>
                        <div class='duraciontarea normal'>".$arrayDuracionTarea[$i]."</div>".
                  "<div class='cantidadpersonal normal'>".$arrayCantidadPersonal[$i]."</div>".
                  "</div>".
                  "<div class='bordeado row-7 normal' style='border-top: 0px'>".
                  "<div class='duraciontareaRow normal' style='border-right: 1px solid black'>".$arrayCodigoMaterial[$i]."</div>".
                  "<div class='cantidadpersonalRow normal' style='border-left: 1px solid black'>".$arrayCantidad[$i]."</div>".
                  "</div>".
                  "</div>";
          }

        }
        for ($i=0;$i<$relleno;$i++){
            echo "<div class='bordeado row' style='border-top: 0px'>
                    <div class='bordeado row-1' style='border-top: 0px;border-left: 0px'></div>".
                "<div class='row-2'>
                        <div class='bordeado letras2-1'></div>
                        <div class='bordeado letras2-1'></div>
                        <div class='bordeado letras2-1'></div>
                        <div class='bordeado letras2-1'></div>
                        <div class='bordeado letras2-1'></div>
                        <div class='bordeado letras2-1'></div>
                    </div>".
                "<div class='bordeado row-3' style='border-top: 0px'></div>
                    <div class='row-4' >
                        <div class='bordeado numeros2-1'></div>
                        <div class='bordeado numeros2-2'></div>
                        <div class='bordeado numeros2-3'></div>
                        <div class='bordeado numeros2-4'></div>
                    </div>".
                "<div class='bordeado row-5' style='border-top: 0px'>"."</div>".
                "<div class='bordeado row-6' style='border-top: 0px'>
                        <div class='duraciontarea'>"."</div>".
                "<div class='cantidadpersonal'></div>".
                "</div>".
                "<div class='bordeado row-7' style='border-top: 0px'>".
                "<div class='duraciontareaRow' style='border-right: 1px solid black'>"."</div>".
                "<div class='cantidadpersonalRow' style='border-left: 1px solid black'>"."</div>".
                "</div>".
                "</div>";
        }
        ?>
    </div>
        <!-- END LOOP-->
    <div class='footer bordeado' >
        <div class=" parte-1">
            <div class=" leyenda"><span class="leyenda2">Leyenda</span> </div>
            <div class="listas">
                <div class="lista-0"></div>
                <div class="lista-1">
                    <li>A. Mecánico</li>
                    <li>B. Eléctrico</li>
                    <li>C. Electrónico</li>
                    <li>D. Neumático</li>
                    <li>E. Hidráulico</li>
                    <li>F. Otros</li>
                </div>
                <div class="lista-2">

                    <li>1: Mantenimiento Preventivo</li>
                    <li>2: Mantenimiento Correctivo</li>
                    <li>3: Inspección</li>
                    <li>4: Otro</li>
                </div>
            </div>
        </div>
        <div class=" parte-2">
            <div class="titulo-observacones">Observaciones</div>
            <div class=" observaciones">
                <div class=" observaciones-1">{{$ordenTrabajo->observacion}}</div>
                <div class="observaciones-2"></div>
                <div class="observaciones-3"></div>
            </div>
            <div class=" firmas">
                <div class="firma-1">Firma Supervisor</div>
                <div class="firma-2">OP Equipo</div>
                <div class="firma-3">Firma Ejecutor</div>
                <div class="firma-4">V°B° Director Obra</div>
            </div>
        </div>
        <div class="parte-3"></div>
    </div>
@endforeach
</div>
</body>
</html>