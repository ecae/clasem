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

@include('asignarmaquinaria.modalCrearAsignacion')
@include('asignarmaquinaria.modalActualizarAsignacion')
@include('asignarmaquinaria.modalEliminarAsignacion')
@include('asignarmaquinaria.modalVer')



<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">Asignacion</h4>
    </div>
</div>
<!-- Page-Title -->


<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>Lista Asignaciones</b></h4>
            <p class="text-muted font-13 m-b-30">
                Maquinarias asignadas en la Base de Datos.
            </p>
            <div class="row">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <div class="col-md-5 col-sm-push-0 col-xs-push-2 pull-left">
                    <button type="button"  class="btn btn-success" data-toggle='modal' data-target='#myModal' ><i class='fa fa-plus fa-fw'></i> Agregar</button>

                </div>
            </div>
            <br>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombres y Apellidos</th>
                    <th>Maquinaria</th>
                    <th>Descripci&oacute;n</th>
                    <th>Acciones</th>

                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
@section('js')
    <script src="{{ asset('tema1/js/parsley.min.js') }}"></script>
    <script src="{{ asset('tema1/js/jquery.dataTables.min.js') }}"></script>
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
        datatable();
        actualizar();
        delete_asignacion();

    });
   function datatable() {
       $('#datatable-responsive').DataTable( {
           "destroy":true,
           "processing": true,
           "serverSide": true,
           "ajax": "getAsignacion",
           "columns":[
               {data:'id'},
               {data:'ncompletos'},
               {data:'equipo'},
               {data:'descripcion'},
               {data: 'action', name: 'action', orderable: false, searchable: false}
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
               var dato = $("#descripcion").val();
               var dato2 = $("#fichatecnica_id").val();
               var dato3=$('#persona_id').val();
               var dato4 = $("#estado").val();
               $.ajax({
                   url: 'asignacion',
                   headers: { 'X-CSRF-Token' : token },
                   type: 'POST',
                   dataType: 'json',
                   data: {descripcion: dato,
                          fichatecnica_id:dato2,
                          persona_id:dato3,
                          estado:dato4
                   },
                   success: function(data){
                       datatable();
                       $("#myModal").modal('toggle');
                       toastr.success('Se ha asignado para : '+data.mensaje+' exitosamente ', {timeOut: 5000});
                       vm.descripcion='';
                       vm.fichatecnica_id='';
                       vm.persona_id='';
                       vm.estado='';
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
               //$("#myModal").modal('toggle');
               toastr.success('Datos no validos', {timeOut: 5000});
           }
       });
   }
   function actualizar() {
       $("#form_actualizar").on('submit', function(e){
           e.preventDefault();
           var form = $(this);
           var bool=form.parsley().validate();
           if(bool){
               var token = $("#token").val();
               var dato = $("#descripcion2").val();
               var dato2 = $("#fichatecnica_id2").val();
               var dato3=$('#persona_id2').val();
               var dato4 = $("#estado2").val();
               var id= $("#id_actualizar").val();
               $.ajax({
                   url: "asignacion/"+id+"",
                   headers: { 'X-CSRF-Token' : token },
                   type: 'PUT',
                   dataType: 'json',
                   data: {descripcion: dato,
                       fichatecnica_id:dato2,
                       persona_id:dato3,
                       estado:dato4
                   },
                   success: function(data1){
                       datatable();
                       $("#myModal2").modal('toggle');
                       toastr.success('Asignacion: '+data1.mensaje+' a sido actualizada', {timeOut: 5000});
                       vm.cambio1=false;
                       vm.cambio2=false;
                       vm.cambio3=false;
                       vm.cambio4=false;
                   },
                   error: function(data1){
                       $("#myModal2").modal('toggle');
                       var errors = '';
                       for(datos in data1.responseJSON){
                           errors += '* '+data1.responseJSON[datos] + '<br>';
                       }
                       toastr.error(errors, {timeOut: 5000});
                   }
               });

           }else{

               //$("#myModal").modal('toggle');
               //toastr.success('Datos no validos', {timeOut: 5000});
           }
       });
   }
    function Mostrar(btn){

        $.get("asignacion/"+btn.value+"/edit", function(res){
            $("#descripcion2").val(res.descripcion);
            $("#fichatecnica_id2").val(res.fichatecnica_id);
            $("#persona_id2").val(res.persona_id);
            $("#estado2").val(res.estado);
            $("#id_actualizar").val(btn.value);

            $("#id_o_descripcion").val(res.descripcion);
            $("#id_o_ficha").val(res.fichatecnica_id);
            $("#id_o_persona").val(res.persona_id);
            $("#id_o_estado").val(res.estado);

        });
    }
    function Ver(btn){

        $.getJSON("asignacion/"+btn.value+"/edit2",function (result) {
            $.each(result, function(i, res){
                var estado=res.estado;
                $("#descripcion5").text(res.descripcion);
                $("#ncompletos5").text(res.ncompletos);
                $("#equipo5").text(res.equipo);
                $("#marca5").text(res.marca);
                $("#modelo5").text(res.modelo);

                if(estado==1){$("#estado5").text('Activo');}
                else {$("#estado5").text('Suspendido');};

                $("#id").val(btn.value);
            });


        })
    }

    function Eliminar(btn){

        $.get("asignacion/"+btn.value+"/edit", function(res){
            $("#id_asignacion_eliminar").val(btn.value);
            $("#asignacion_descripcion").html(res.descripcion);
        });
    }
    function delete_asignacion() {
        $("#form_eliminar").on('submit', function(e){
            var value = $("#id_asignacion_eliminar").val();
            var token = $("#token2").val();
            e.preventDefault();
            $.ajax({
                url:"asignacion/"+value+"",
                headers: { 'X-CSRF-Token' : token },
                type: 'DELETE',
                dataType: 'json',

                success: function(data3){
                    datatable();
                    $("#myModal9").modal('toggle');
                    toastr.warning('La asignacion ha sido eliminada '+data3.mensaje, {timeOut: 5000});

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
            descripcion:'',
            fichatecnica_id:'',
            persona_id:'',
            estado:'',

            cambio1:false,
            cambio2:false,
            cambio3:false,
            cambio4:false,


        },
        computed:{
            activando: function () {
                return this.descripcion && this.fichatecnica_id && this.persona_id && this.estado;
            },
            activando2: function () {
                return this.cambio1 || this.cambio2  || this.cambio3 || this.cambio4;
            }

        },
        watch: {

        },
        methods: {
            changeDescripcion:function (event) {
                if($("#id_o_descripcion").val().toLowerCase()==event.target.value.toLowerCase()){
                    this.cambio1=false;
                }else {this.cambio1=true;}

            },
            changeFicha:function (event) {
                if($("#id_o_ficha").val()==event.target.value){
                    this.cambio2=false;
                }else {this.cambio2=true;}

            },
            changePersona:function (event) {
                if($("#id_o_persona").val()==event.target.value){
                    this.cambio3=false;
                }else {this.cambio3=true;}

            },

            changeEstado:function (event) {
                if($("#id_o_estado").val()==event.target.value){
                    this.cambio4=false;
                }else {this.cambio4=true;}

            },
            cancelarCrear:function(){
                this.descripcion="";
                this.fichatecnica_id="";
                this.persona_id="";
                this.estado="";
            },
            cancelarActualizar:function(){
                this.cambio1=false;
                this.cambio2=false;
                this.cambio3=false;
                this.cambio4=false;
            }

        }

    });


</script>
<!--<script src="{{ asset('js/asignacion_vue.js') }}"></script> -->
@endpush