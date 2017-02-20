@extends('layouts.original')
@push('css')
<link rel="stylesheet" href="{{ asset('tema1/css/jquery.dataTables.min.css') }}" />
<link rel="stylesheet" href="{{ asset('tema1/css/buttons.bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('tema1/css/fixedHeader.bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('tema1/css/responsive.bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('tema1/css/scroller.bootstrap.min.css') }}" />

<link rel="shortcut icon" href="{{ asset('tema1/img/favicon_1.ico') }}">
<link rel="stylesheet" href="{{ asset('tema1/css/custombox.min.css') }}" />
<link rel="stylesheet" href="{{ asset('tema1/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('tema1/css/toastr.min.css') }}" />

@endpush
@section('content')

@include('mantenimientos.modalCrearMantenimiento')
@include('mantenimientos.modalCreaMantenimientoCorrectivo')
@include('mantenimientos.modalActualizarMantenimiento')
@include('mantenimientos.modalConfirmacionMantenimiento')
@include('mantenimientos.modalCompletarAltaMantenimiento')
@include('mantenimientos.modalEliminarMantenimiento')
<!--
<div class="row">
    <div class="col-sm-12">
        <div class="card-box ">

            <h4 class="m-t-0 header-title"><b>Lista de Mantenimiento</b></h4>
            <p class="text-muted font-13 m-b-30">
                Detalle de los mantenimientos y su estado.
            </p>
            <div class="row">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <div class="col-md-1 col-sm-push-0 col-xs-push-2 pull-left">
                    <button type="button"  class="btn btn-success" data-toggle='modal' data-target='#myModal' ><i class='fa fa-plus fa-fw'></i> Agregar</button>

                </div>
                <div class="col-md-1 col-sm-push-0 col-xs-push-2 pull-left">
                    <a href="/admin/HistorialMantenimientos" class="btn btn-default">Historial de Mantenimientos</a>
                </div>
            </div>
            <br>

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr >
                    <th>ID</th>
                    <th>Mantenimiento</th>
                    <th>Equipo</th>
                    <th>&Uacute;ltimo Horometro</th>
                    <th>L&iacute;mite Horometro</th>
                    <th>Fecha de Mant.</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
-->
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive ">

            <h4 class="m-t-0 header-title"><b>Mantenimientos</b></h4>
            <p class="text-muted font-13 m-b-30">
                Mantenimientos registrados en la Base de Datos.
            </p>
            <div class="row">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <div class="col-md-1 col-sm-push-0 col-xs-push-2 pull-left">
                    <div class='btn-group dropup'>
                        <button type='button' class='btn btn-success dropdown-toggle waves-effect waves-light' data-toggle='dropdown' aria-expanded='false'><i class='fa fa-plus fa-fw'></i>Agregar <span class='caret'></span></button>
                        <ul class='dropdown-menu' role='menu'>
                            <li><a href='#' data-toggle='modal' data-target='#myModal' >MTTO Preventivo</a></li>
                            <li><a href='#' data-toggle='modal' data-target='#myModal15' >MTTO Correctivo</a></li>
                        </ul>
                    </div>
                    <!--<button type="button"  class="btn btn-success" data-toggle='modal' data-target='#myModal' ><i class='fa fa-plus fa-fw'></i> Agregar</button>-->

                </div>
            </div>
            <br>
            <ul class="nav nav-pills m-b-30">
                <li class="active">
                    <a href="#navpills-11" data-toggle="tab" aria-expanded="true" >Mantenimientos</a>
                </li>
                <li class="">
                    <a href="#navpills-41" data-toggle="tab" aria-expanded="false" v-on:click="tapEstado" >Estado de Mantenimientos</a>
                </li>
                <li class="">
                    <a href="#navpills-21" data-toggle="tab" aria-expanded="false" v-on:click="tapInterno">MTTOS realizados por Interno</a>
                </li>
                <li class="">
                    <a href="#navpills-31" data-toggle="tab" aria-expanded="false" v-on:click="tapProveedor">MTTOS realizados por Proveedor</a>
                </li>
            </ul>
            <div class="tab-content br-n pn">
                <div id="navpills-11" class="tab-pane active">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="datatable-mantenimientos" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                                <thead>
                                <tr >
                                    <th>ID</th>
                                    <th>Mantenimiento</th>
                                    <th>Maquinaria</th>
                                    <th>Limite Horometro</th>
                                    <th>Fecha de Inicial.</th>
                                    <th>Fecha de Mant.</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="navpills-41" class="tab-pane">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="datatable-estado" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                                <thead>
                                <tr >
                                    <th>ID</th>
                                    <th>Mantenimiento</th>
                                    <th>Maquinaria</th>
                                    <th>&Uacute;ltimo Horometro</th>
                                    <th>L&iacute;mite Horometro</th>
                                    <th>Fecha de Mant.</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="navpills-21" class="tab-pane">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="datatable-interno" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr >
                                    <th>ID</th>
                                    <th>Mantenimiento</th>
                                    <th>Maquinaria</th>
                                    <th>Modalidad</th>
                                    <th>Operador</th>
                                    <th>S/.</th>
                                    <th>Acciones</th>

                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="navpills-31" class="tab-pane">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="datatable-proveedor" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr >
                                    <th>ID</th>
                                    <th>Mantenimiento</th>
                                    <th>Maquinaria</th>
                                    <th>Raz&oacute;n Social</th>
                                    <th>Operador</th>
                                    <th>S/.</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
    <script src="{{ asset('tema1/js/parsley.min.js') }}"></script>
    <script src="{{ asset('tema1/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('tema1/js/bootstrap-inputmask.min.js') }}"></script>
    <script src="{{ asset('tema1/js/vue.js') }}"></script>
    <script src="{{ asset('tema1/js/vue-resource.js') }}"></script>
    <script src="{{ asset('tema1/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('tema1/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('tema1/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('tema1/js/jszip.min.js') }}"></script>
    <script src="{{ asset('tema1/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('tema1/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('tema1/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('tema1/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('tema1/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('tema1/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('tema1/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('tema1/js/responsive.bootstrap.min.js') }}"></script>
    <script src="{{ asset('tema1/js/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('tema1/js/datatables.init.js') }}"></script>
    <script src="{{ asset('tema1/js/toastr.min.js') }}"></script>

@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        parsley();
        //datatable();
        datatable_mantenimientos();
        //datatable_interno();
        //datatable_proveedor();
        actualizar_alta_mantenimiento();
        Actualizar();
        delete_mantenimiento();
        cerrarModalAltaMantenimiento();
        cerrarModalCrearMantenimiento();
        addMTTOcorrectivo();
        cerrarModalMTTOcorrectivo();

    });
   function cerrarModalCrearMantenimiento() {
       $('#myModal').on('hidden.bs.modal', function () {
           $(this).find("input,textarea,select").val('').end();
           vm.cambiohorometro=false;
           vm.cambiofecha=false;
           vm.fichatecnica_id="";
           vm.detalle="";
           vm.fecha_inicial="";
           vm.horometro="";
           vm.estado="";
           vm.dias_mantenimiento='';
           vm.requi1=false;
           vm.requi2=false;
           vm.tipo_modalidadCrear="";
       });

   }
   function cerrarModalAltaMantenimiento(){
        $('#myModal8').on('hidden.bs.modal', function () {
            $(this).find("input,textarea,select").val('').end();
            vm.tipo_modalidad ="";
            vm.proveedor="";
            vm.interno="";
            vm.costo="";
            vm.precio="";
            vm.Nfecha_inicial="";
            vm.ordentrabajo="";
            vm.file_orden="";
            vm.Nhorometro="";
            vm.cambioaltafecha=false;
            vm.cambioaltahorometro=false;
            vm.cambioproveedor=false;
            vm.cambiointerno=false;
            vm.errorFecha='none';
            vm.errorNfechaBorder='#EEEEEE';
            vm.errorLimite='none';
            vm.errorNhorometroBorder='#EEEEEE';
        });
    }
   function datatable() {
       $('#datatable-estado').DataTable( {
           "destroy":true,
           "processing": true,
           "serverSide": true,
           "ajax": "getMantenimientos",
           "columns":[
               {data:'id'},
               {data:'mantenimiento'},
               {data:'equipo'},
               {data:'final_horometro'},
               {data:'limite_horometro'},
               {data:'fecha_mantenimiento'},
               {data:'estado'},
               {data: 'action', name: 'action', orderable: false, searchable: false}
           ]
       } );
   }
   function datatable_mantenimientos() {
        $('#datatable-mantenimientos').DataTable( {
            "destroy":true,
            "processing": true,
            "serverSide": true,
            "ajax": "getMantenimientos_historial",
            "columns":[
                {data:'id'},
                {data:'mantenimiento'},
                {data:'equipo'},
                {data:'limite_horometro'},
                {data:'fecha_inicial'},
                {data:'fecha_mantenimiento'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        } );

    }
   function datatable_interno() {
        $('#datatable-interno').DataTable( {
            "destroy":true,
            "processing": true,
            "serverSide": true,
            "ajax": "getMantenimientos_Interno",
            "columns":[
                {data:'id'},
                {data:'mantenimiento'},
                {data:'equipo'},
                {data:'razonsocial'},
                {data:'interno'},
                {data:'costo'}
            ]
        } );

    }
   function datatable_proveedor() {
        $('#datatable-proveedor').DataTable( {
            "destroy":true,
            "processing": true,
            "serverSide": true,
            "ajax": "getMantenimientos_Proveedor",
            "columns":[
                {data:'id'},
                {data:'mantenimiento'},
                {data:'equipo'},
                {data:'razonsocial'},
                {data:'interno'},
                {data:'costo'}
            ]
        } );

    }
   function parsley() {
       var token = $("#token").val();
       $("#form_registrar").on('submit', function(e){
           e.preventDefault();
           var form = $(this);
            var bool=form.parsley().validate();
           if(bool){
               var dato = $("#fichatecnica_id").val();
               var dato3=$('#detalle').val();
               var dato4=$('#fecha_inicial').val();
               var dato5=$('#limite_horometro').val();
               var dato6 = $("#estado").val();
               var dato7=$("#dias_mantenimiento").val();
               $.ajax({
                   url: 'mantenimientos',
                   headers: { 'X-CSRF-Token' : token },
                   type: 'POST',
                   dataType: 'json',
                   data: {fichatecnica_id: dato,
                          detalle:dato3,
                          fecha_inicial:dato4,
                          limite_horometro:dato5,
                          estado:dato6,
                          dias:dato7
                   },
                   success: function(data){

                       datatable_mantenimientos();
                       $("#myModal").modal('toggle');
                       toastr.success('Mantenimiento de : '+data.mensaje+' a sido registrado', {timeOut: 5000});
                       vm.cambiohorometro=false;
                       vm.cambiofecha=false;
                       vm.fichatecnica_id="";
                       vm.detalle="";
                       vm.fecha_inicial="";
                       vm.horometro="";
                       vm.estado="";
                       vm.dias_mantenimiento='';
                       vm.tipo_modalidadCrear='';
                       vm.requi1=false;
                       vm.requi2=false;


                   },
                   error: function(data){
                       $("#myModal").modal('toggle');
                       var errors = '';
                       for(datos in data.responseJSON){
                           errors += '* '+data.responseJSON[datos] + '<br>';
                       }
                       toastr.error(errors, {timeOut: 5000});
                   }
               });
               //$("#myModal").modal('toggle');
               //toastr.error('Registrado Correctamente', {timeOut: 5000});
           }else{
               $("#myModal").modal('toggle');
               toastr.success('Datos no validos', {timeOut: 5000});
           }
       });
   }
   function actualizar_alta_mantenimiento() {
       var token = $('meta[name="csrf-token"]').attr('content');
       $("#form_alta_mantenimiento").on('submit', function(e){
           e.preventDefault();
           var form = $(this);
           var bool=form.parsley().validate();
           if(bool){
               $.ajax({
                   url: 'altaMantenimientos',
                   headers: { 'X-CSRF-Token' : token },
                   type: 'POST',
                   dataType: 'json',
                   data:new FormData($("#form_alta_mantenimiento")[0]),
                   contentType: false,
                   processData: false,
                   success: function(data1){
                       datatable();
                       $("#myModal8").modal('toggle');
                       toastr.success('Datos registrados  : '+data1.mensaje+'', {timeOut: 5000});
                       vm.tipo_modalidad ="";
                       vm.proveedor="";
                       vm.interno="";
                       vm.costo="";
                       vm.precio="";
                       vm.Nfecha_inicial="";
                       vm.ordentrabajo="";
                       vm.file_orden="";
                       vm.Nhorometro="";
                       vm.cambioaltafecha=false;
                       vm.cambioaltahorometro=false;
                       vm.cambioproveedor=false;
                       vm.cambiointerno=false;
                       vm.errorFecha='none';
                       vm.errorNfechaBorder='#EEEEEE';
                       vm.errorLimite='none';
                       vm.errorNhorometroBorder='#EEEEEE';
                   },
                   error: function(data1){
                       $("#myModal8").modal('toggle');
                       var errors = '';
                       for(datos in data1.responseJSON){
                           errors += '* '+data1.responseJSON[datos] + '<br>';
                       }
                       toastr.error(errors, {timeOut: 5000});
                   }

               });

           }else{
               $("#myModal8").modal('toggle');
               toastr.success('Datos no validos', {timeOut: 5000});
           }
       });
   }
   function addMTTOcorrectivo() {
        var token = $('meta[name="csrf-token"]').attr('content');
        $("#form_mantenimiento_correctivo").on('submit', function(e){
            e.preventDefault();
            var form = $(this);
            var bool=form.parsley().validate();
            if(bool){
                $.ajax({
                    url: 'AddMantenimientoCorrectivo',
                    headers: { 'X-CSRF-Token' : token },
                    type: 'POST',
                    dataType: 'json',
                    data:new FormData($("#form_mantenimiento_correctivo")[0]),
                    contentType: false,
                    processData: false,
                    success: function(data5){
                        $("#myModal15").modal('toggle');
                        toastr.success('Mantenimiento de : '+data5.mensaje+' a sido registrado', {timeOut: 5000});
                        vm.fichatecnica_id="";
                        vm.detalle="";
                        vm.tipo_modalidad ="";
                        vm.descripcionMTTO="";
                        vm.proveedor="";
                        vm.interno="";
                        vm.costo="";
                        vm.precio="";
                        vm.ordentrabajo="";
                        vm.file_orden="";
                        vm.cambioproveedor=false;
                        vm.cambiointerno=false;
                    },
                    error: function(data5){

                        $("#myModal15").modal('toggle');
                        var errors = '';
                        for(datos in data5.responseJSON){
                            errors += '* '+data5.responseJSON[datos] + '<br>';
                        }
                        toastr.error(errors, {timeOut: 5000});
                    }

                });

            }else{
                $("#myModal8").modal('toggle');
                toastr.success('Datos no validos', {timeOut: 5000});
            }
        });
    }
   function cerrarModalMTTOcorrectivo() {
       $('#myModal15').on('hidden.bs.modal', function () {
           $(this).find("input,textarea,select").val('').end();
           vm.fichatecnica_id="";
           vm.detalle="";
           vm.tipo_modalidad ="";
           vm.descripcionMTTO="";
           vm.proveedor="";
           vm.interno="";
           vm.costo="";
           vm.precio="";
           vm.ordentrabajo="";
           vm.file_orden="";
           vm.cambioproveedor=false;
           vm.cambiointerno=false;
       });
   }
   function AltaMantenimiento(btn){
        $("#id_actualizar_mantenimiento").val(btn.value);
        $.get("mantenimientos/"+btn.value+"/edit", function(res){
            $('#id_actualizar_alta').val(res.id);
            $("#id_o_fechaInicial").val(res.fecha_mantenimiento);
            $("#id_o_horometro").val(res.limite_horometro);
            vm.Ofecha_inicial=res.fecha_mantenimiento;
            vm.Ohorometro=res.limite_horometro;
        });
    }
   function MostrarAlta(){

    }
   function Mostrar(btn){
       $.get("mantenimientos/"+btn.value+"/edit", function(res){
           $('#id_actualizar_mantenimiento').val(btn.value);
           vm.fichatecnica_id=res.fichatecnica_id;
           vm.detalle=res.detalle;
           vm.estado=res.estado;
           if(res.limite_horometro !=null){
               vm.tipo_modalidadCrear=0;
               vm.cambiohorometro=true;
               vm.cambiofecha=false;
               vm.horometro=res.limite_horometro;
               vm.fecha_inicial="";
               vm.dias_mantenimiento="";
               vm.requi1=true;
               vm.requi2=false;

           }else{
               vm.tipo_modalidadCrear=1;
               vm.cambiohorometro=false;
               vm.cambiofecha=true;
               vm.fecha_inicial=res.fecha_inicial;
               vm.dias_mantenimiento=res.dias;
               vm.requi1=false;
               vm.requi2=true;
           }


       });
    }
   function Actualizar() {
       var token = $('meta[name="csrf-token"]').attr('content');
       $("#form_actualizar").on('submit', function(e){
           e.preventDefault();
           var form = $(this);
           var bool=form.parsley().validate();
           if(bool){
               var id= $('#id_actualizar_mantenimiento').val();
               $.ajax({
                   url: "mantenimientos/"+id+"",
                   headers: { 'X-CSRF-Token' : token },
                   type: 'PUT',
                   dataType: 'json',
                   data: {fichatecnica_id: vm.fichatecnica_id,
                       detalle:vm.detalle,
                       fecha_inicial:vm.fecha_inicial,
                       limite_horometro:vm.horometro,
                       estado:vm.estado,
                       dias:vm.dias_mantenimiento
                   },
                   success: function(data21){

                       datatable_mantenimientos();
                       $("#myModal2").modal('toggle');
                       toastr.success('Mantenimiento: '+data21.mensaje+' a sido actualizado', {timeOut: 5000});
                       vm.cambiohorometro=false;
                       vm.cambiofecha=false;
                       vm.fichatecnica_id="";
                       vm.detalle="";
                       vm.fecha_inicial="";
                       vm.horometro="";
                       vm.estado="";
                       vm.dias_mantenimiento='';
                       vm.requi1=false;
                       vm.requi2=false;
                       vm.tipo_modalidadCrear="";
                   },
                   error: function(data21){

                       $("#myModal2").modal('toggle');
                       var errors = '';
                       for(datos in data21.responseJSON){
                           errors += '* '+data21.responseJSON[datos] + '<br>';
                       }
                       toastr.error(errors, {timeOut: 5000});
                       //console.log(data1);
                   }
               });

           }else{

               $("#myModal").modal('toggle');
               toastr.success('Datos no validos', {timeOut: 5000});
           }
       });
   }
   function Ver(btn){
       var url="MantenimientoPDF/"+btn.value;
       window.open(url, '_blank');
    }
   function Eliminar(btn){
        $.get("mantenimientos/"+btn.value+"/edit", function(res){
            $("#id_mantenimiento_preventivo_eliminar").val(btn.value);
            $("#mantenimiento_correctivo").html(res.detalle);
        });
    }
   function delete_mantenimiento() {
        $("#form_eliminar_preventivo").on('submit', function(e){
            var value = $("#id_mantenimiento_preventivo_eliminar").val();
            var token = $('meta[name="csrf-token"]').attr('content');
            e.preventDefault();
            $.ajax({
                url:"mantenimientos/"+value+"",
                headers: { 'X-CSRF-Token' : token },
                type: 'DELETE',
                dataType: 'json',
                success: function(data3){

                    datatable_mantenimientos();
                    $("#myModal9").modal('toggle');
                    toastr.warning('Mantenimiento ha sido eliminado '+data3.mensaje, {timeOut: 5000});

                },
                error: function(data3){
                    $("#myModal9").modal('toggle');
                    var errors = '';
                    for(datos in data3.responseJSON){
                        errors += '* '+data3.responseJSON[datos] + '<br>';
                    }
                    toastr.error(errors, {timeOut: 5000});
                }
            });

        });
    }

    var vm=new Vue({
        el:'#my_app',
        data:{
            fichatecnica_id:'',
            detalle:'',
            tipo_modalidadCrear:'',
            tipo_mantenimiento:'',
            fecha_inicial:'',
            dias_mantenimiento:'',
            horometro: '',
            estado:'',

            tipo_modalidad:'',
            Ofecha_inicial:'',
            Ohorometro: '',
            Nfecha_inicial:'',
            Nhorometro: '',
            precio:'',
            interno:'',
            proveedor:'',
            ordentrabajo:'',
            descripcionMTTO:'',
            file_orden:'',

            cambio1:false,
            cambio2:false,
            cambio3:false,
            cambio4:false,
            cambio5:false,

            cambiofecha:false,
            cambiohorometro:false,
            cambioaltafecha:false,
            cambioaltahorometro:false,

            cambioproveedor:false,
            cambiointerno:false,

            requi1:false,
            requi2:false,

            errorFecha:'none',
            errorNfechaBorder:'#EEEEEE',
            errorLimite:'none',
            errorNhorometroBorder:'#EEEEEE',
            estadoNfecha:false,


        },
        computed:{
            activando: function () {
                return this.fichatecnica_id && this.detalle  && this.tipo_modalidadCrear && this.estado;
            },
            activando2: function () {
                //    return this.cambio1 || this.cambio2  || this.cambio3 || this.cambio4 || this.cambio5  ;
            },
            activando3: function () {
                return (this.fecha_inicial && this.dias_mantenimiento>0) || this.horometro>0;
            },
            activando_actualizar_preventivo:function(){
                return this.fichatecnica_id && this.detalle  && this.estado &&((this.fecha_inicial && this.dias_mantenimiento>0) || this.horometro>0);
            },
            activando_alta: function () {

                if(this.tipo_modalidad==0){
                    if(this.Ohorometro==null){
                       return this.tipo_modalidad && this.proveedor &&  this.precio>0  && this.Nfecha_inicial && this.ordentrabajo && this.file_orden;
                    }
                    else if(this.Ofecha_inicial==null) {
                        return this.tipo_modalidad && this.proveedor &&  this.precio>0  && this.Nhorometro>0 && this.Nhorometro>this.Ohorometro && this.ordentrabajo && this.file_orden ;
                    }
                }else {
                    if(this.Ohorometro==null){
                        return this.tipo_modalidad && this.interno &&  this.precio>0  && this.Nfecha_inicial && this.ordentrabajo ;
                    }
                    else if(this.Ofecha_inicial==null) {
                        return this.tipo_modalidad && this.interno &&  this.precio>0  && this.Nhorometro>0 && this.Nhorometro>this.Ohorometro && this.ordentrabajo ;
                        }

                }

            },
            activando_addCorrectivo: function () {
                if(this.tipo_modalidad==0){
                        return this.fichatecnica_id && this.detalle && this.tipo_modalidad && this.proveedor &&  this.precio>0  && this.ordentrabajo && this.descripcionMTTO &&this.file_orden;
                }else {
                        return this.fichatecnica_id && this.detalle && this.tipo_modalidad && this.interno &&  this.precio>0  && this.ordentrabajo && this.descripcionMTTO ;
                }
            },
            required:function () {
                if(this.cambio3 || this.cambio4){
                    return true;
                }else{
                    return false;
                }
            },

        },
        watch: {

        },
        methods: {
            changeTipomantenimiento:function (event) {

            },
            changeModalidadCrear:function (event) {

                if(event.target.value==0){
                    this.cambiohorometro=true;
                    this.cambiofecha=false;
                    this.requi1=true;
                    this.requi2=false;
                    this.fecha_inicial='';
                    this.horometro='';
                    this.dias_mantenimiento='';

                }else {
                    this.cambiofecha=true;
                    this.cambiohorometro=false;
                    this.requi2=true;
                    this.requi1=false;
                    this.fecha_inicial='';
                    this.horometro='';
                    this.dias_mantenimiento='';
                }

            },

            changeVisible:function (event) {
                if(event.target.value==''){
                    this.horometro=false;
                }
                else{
                    this.horometro=true;
                }


            },

            changeTipomodalidad:function (event) {

             if(event.target.value==0){
                     this.cambioproveedor=true;
                     this.cambiointerno=false;
                     this.interno='';
                     this.proveedor='';

             }else {
                     this.cambioproveedor=false;
                     this.cambiointerno=true;
                     this.interno='';
                     this.proveedor='';
                    }
             },
            cancelarCrearMantenimiento:function(){
                this.cambiohorometro=false;
                this.cambiofecha=false;
                this.fichatecnica_id="";
                this.detalle="";
                this.fecha_inicial="";
                this.horometro="";
                this.estado="";
                this.dias_mantenimiento='';
                this.requi1=false;
                this.requi2=false;
                tipo_modalidadCrear='';

            },
            cancelarActualizar:function(){
                this.cambio1=false;
                this.cambio2=false;
                this.cambio3=false;
                this.cambio4=false;
                this.cambio5=false;
                this.cambio6=false;
            },
            confirmacionSi:function () {
                $("#myModal7").modal('toggle');
                $("#myModal8").modal();

                if(this.Ohorometro==null){
                    this.cambioaltafecha=true;
                    this.cambioaltahorometro=false;
                    this.Nfecha_inicial = '';
                    this.Nhorometro = '';

                }
                else if(this.Ofecha_inicial==null) {
                    this.cambioaltahorometro=true;
                    this.cambioaltafecha=false;
                    this.Nfecha_inicial = '';
                    this.Nhorometro = '';
                     }
            },
            cancelarAlta:function () {
                this.cambioaltahorometro=false;
                this.cambioaltafecha=false;
                this.errorFecha='none';
                this.errorNfechaBorder='#EEEEEE';
                this.errorLimite='none';
                this.errorNhorometroBorder='#EEEEEE';
                this.tipo_modalidad='';
                this.Nfecha_inicial = '';
                this.Nhorometro = '';
                this.precio = '';
                this.interno = '';
                this.proveedor = '';
                this.file_orden='';
            },
            VerificandoNFecha:function (event) {
                var nfecha=new Date(event.target.value);
                var fecha_mantenimieto= new Date(this.Ofecha_inicial);
               ;
                if(nfecha>fecha_mantenimieto){
                    this.estadoNfecha=true;
                    this.errorFecha='none';
                    this.errorNfechaBorder='#EEEEEE';

                }
                else{
                    this.errorFecha='block';
                    this.errorNfechaBorder='#ef5350';
                    this.estadoNfecha=false;
                }

            },
            VerificandoNhorometro:function (event) {
                var nhorometro=event.target.value;
                var horometro_mantenimieto=$("#id_o_horometro").val();
                if(nhorometro>this.Ohorometro){
                    this.estadoNfecha=true;
                    this.errorLimite='none';
                    this.errorNhorometroBorder='#EEEEEE';

                }
                else{
                    this.errorLimite='block';
                    this.errorNhorometroBorder='#ef5350';
                    this.estadoNfecha=false;
                }
            },
            tapEstado:function () {
                $('#datatable-estado').DataTable( {
                    "destroy":true,
                    "processing": true,
                    "serverSide": true,
                    "ajax": "getMantenimientos",
                    "columns":[
                        {data:'id'},
                        {data:'mantenimiento'},
                        {data:'equipo'},
                        {data:'final_horometro'},
                        {data:'limite_horometro'},
                        {data:'fecha_mantenimiento'},
                        {data:'estado'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                    ]
                } );
            },
            tapInterno:function () {
                $('#datatable-interno').DataTable( {
                    "destroy":true,
                    "processing": true,
                    "serverSide": true,
                    "ajax": "getMantenimientos_Interno",
                    "columns":[
                        {data:'id'},
                        {data:'mantenimiento'},
                        {data:'equipo'},
                        {data:'razonsocial'},
                        {data:'interno'},
                        {data:'costo'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                    ]
                } );
            },
            tapProveedor:function () {
                $('#datatable-proveedor').DataTable( {
                    "destroy":true,
                    "processing": true,
                    "serverSide": true,
                    "ajax": "getMantenimientos_Proveedor",
                    "columns":[
                        {data:'id'},
                        {data:'mantenimiento'},
                        {data:'equipo'},
                        {data:'razonsocial'},
                        {data:'interno'},
                        {data:'costo'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                    ]
                } );
            },
            changePath: function (event) {
                this.file_orden= event.target.value.split('\\').pop();
                //var data = new FormData($("#form_registrar")[0]);
                //this.cambio7 = true;

            },

        },

    });


</script>
<!--<script src="{{ asset('js/mantenimientos_vue.js') }}"></script> -->
@endpush