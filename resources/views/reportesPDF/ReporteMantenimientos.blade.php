<!DOCTYPE html>
<html>
<head>
    <?php echo
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header('Content-Type: text/html');?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sitema de Mantenimiento Santa Margarita">
    <meta name="author" content="CLASEM EON">

    <title>Clasem EOM</title>


    <link rel="stylesheet" href="{{ asset('tema1/css/bootstrap.min.css') }}" />

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>

    <![endif]-->

<style>

    .div1{
        border:1px solid black ;
    }



</style>

</head>


<body>
<div >
    <div class="container">
        <div class="subpage">
          <!--
            <div class="pdf" style="position: relative;margin-left:-76px ">
                <div class="row">
                    <div class="div1 col-sm-3" STYLE="text-align: center">
                        <H3 style="color: #3bafda;font-size: 42px">
                            CLASEM
                        </H3>
                        <h4 style="font-weight: bold;position: relative;left: 75px">
                            EOM
                        </h4>
                    </div>
                    <div class="div1 col-sm-7" style="background: black;text-align: center">
                        <h6 style="font-weight: bold;color:#ffffff ">EQUIPOS Y MAQUINARIAS</h6>
                    </div>
                    <div class="div1 col-sm-2" style=";text-align: center;border-left:0px solid black">
                        <h5 style="font-weight: bold">EQM.002-F04</h5>
                    </div>
                    <div class="div1  col-sm-7" style="text-align: center;height: 49px;position: relative;top: -2px;border-left:0px solid black ">
                        <h4 style="font-weight: bold;position: relative;">REPORTE MANTENIMIENTO</h4>
                    </div>
                    <div class="div1 col-sm-1" style=";text-align: center;border:0px solid black">
                        <h7 style="font-weight: bold">Ver:00</h7>
                    </div>
                    <div class="div1 col-sm-1" style=";text-align: center;border-top:0px solid black;border-bottom:0px solid black">
                        <h7 style="font-weight: bold">F:11/03/17</h7>
                    </div>
                    <div class="div1 col-sm-2" style=";text-align: center;border-left:0px solid black;height: 27px">
                        <h7 style="font-weight: bold">Página: 1 de 1</h7>
                    </div>
                    <div class="div1 col-sm-12" style=";position: relative;top: -2px;border-top:0px solid black ">
                        <br>
                    </div>
                </div>



            </div>
            -->

            <div class="row">
                <div class="div1 col-xs-3" style="height: 65px">
                    <span style="color: #3bafda;font-weight: bold;position: relative;font-size: 40px;left: 13px">CLASEM </span>

                    <span style="font-size:20px ;font-weight: bold;position: relative;top: -18px;left: 150px">EOM</span>
                </div>
                <div class="div1 col-xs-7" style=";text-align: center;background: #3bafda;color: white ">
                    <span style="font-size: 12px;font-weight: bold;position: relative">EQUIPOS Y MAQUINARIAS</span>
                </div>
                <div class="div1 col-xs-2" style=";text-align: center;border-left:0px solid black;">
                    <span style="font-size: 12px;font-weight: bold">EQM.002-F04</span>
                </div>
                <!-- ********************************************** -->
                <div class="div1 col-xs-7" style="height: 43px;text-align: center;position: relative;">
                    <span style="font-size:20px ;top: 7px;font-weight: bold;position: relative;">REPORTE DE MANTENIMIENTO</span>
                </div>
                <div class="div1 col-xs-1" style="text-align: center">
                    <span style="font-size: 09px;font-weight: bold">Ver: 00</span>
                </div>
                <div class="div1 col-xs-1" style=";text-align: center;">
                    <span style="font-size: 09px;font-weight: bold">F:11/03/17</span>
                </div>
                <!-- ********************************************** -->
                <div class="div1 col-xs-2 " style=";text-align: center;border-top: 0px solid black">
                    <span style=";font-weight: bold">Página: 1 de 1</span>
                </div>
                <!-- ********************************************** -->
                <div class="div1 col-xs-12">
                    <br>
                </div>
                <!-- ********************************************** -->
                <div class="div1 col-xs-3">
                    <h5 style=";font-weight: bold">Fecha del Reporte</h5>
                </div>
                <div class="div1 col-xs-9">
                    <h5 style=";font-weight: bold"><?php echo date("m/d/Y"); ?></h5>
                </div>
                <!-- ********************************************** -->
                <div class="div1 col-xs-3">
                    <h5 style=";font-weight: bold">Mantenimiento</h5>
                </div>
                <div class="div1 col-xs-3">
                    <h5 style=";font-weight: bold">Preventivo</h5>
                </div>
                <div class="div1 col-xs-2">
                    <h5 style="color: white;font-weight: bold">Fecha</h5>
                </div>
                <div class="div1 col-xs-2">
                    <h5 style=";font-weight: bold">Correctivo</h5>
                </div>
                <div class="div1 col-xs-2">
                    <h5 style="color: white;font-weight: bold">Preventivo</h5>
                </div>
                <!-- ********************************************** -->
                <div class="div1 col-xs-3">
                    <h5 style=";font-weight: bold">Obra</h5>
                </div>
                <div class="div1 col-xs-9">
                    <h5 style=";font-weight: bold">SANTA MARGARITA DE PIURA II</h5>
                </div>
                <!-- ********************************************** -->
                <div class="div1 col-xs-12" style="">
                    <span style="font-weight: bold" >Equipo/Maquinaria</span>
                </div>
                <!-- ********************************************** -->
                <div class="div1 col-xs-3">
                    <h5 style=";font-weight: bold">Maquinaria Pesada</h5>
                </div>
                <div class="div1 col-xs-3">
                    <h5 style=";font-weight: bold;color: white">Maquinara</h5>
                </div>
                <div class="div1 col-xs-3">
                    <h5 style=";font-weight: bold">Modelo / Serie</h5>
                </div>
                <div class="div1 col-xs-3">
                    <h5 style=";font-weight: bold;color: white">Modelo</h5>
                </div>
                <!-- ********************************************** -->
                <div class="div1 col-xs-3">
                    <h5 style=";font-weight: bold">Vehículo de Transp.</h5>
                </div>
                <div class="div1 col-xs-3">
                    <h5 style=";font-weight: bold;color: white">Maquinara</h5>
                </div>
                <div class="div1 col-xs-3">
                    <h5 style=";font-weight: bold">Modelo / Serie</h5>
                </div>
                <div class="div1 col-xs-3">
                    <h5 style=";font-weight: bold;color: white">Modelo</h5>
                </div>
                <!-- ********************************************** -->
                <div class="div1 col-xs-3">
                    <h5 style=";font-weight: bold">Equipo</h5>
                </div>
                <div class="div1 col-xs-9">
                    <h5 style="color: white;font-weight: bold">Equipo</h5>
                </div>
                <!-- ********************************************** -->
                <div class="div1 col-xs-12" style="">
                    <span style="font-weight: bold" >Descripción de la actividad realizada</span>
                </div>
                <!-- ********************************************** -->
                <div class="div1 col-xs-12" style="height: 400px">
                    <br>
                    <p style="font-weight: bold" > hola</p>
                </div>
                <div class="div1 col-xs-12" style="">
                    <span style="font-weight: bold" >Recomendaciones</span>
                </div>
                <div class="div1 col-xs-12" style="height: 300px">
                    <br>
                    <p style="font-weight: bold" > hola</p>
                </div>
                <div class="div1 col-xs-12" style="height: 200px">
                    <div>
                        <p style="font-weight: bold" >____________________________</p>
                        <p style="font-weight: bold" >  Resp. del Mantenimiento</p>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>




</body>
</html>