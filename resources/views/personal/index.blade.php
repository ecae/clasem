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

@include('personal.modalCrearPersonal')
@include('personal.modalActualizarPersonal')
@include('personal.modalVer')
@include('personal.modalEliminarPersonal')



<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">Usuarios</h4>
    </div>
</div>
<!-- Page-Title -->


<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>Lista de Usuarios</b></h4>
            <p class="text-muted font-13 m-b-30">
                Usuarios registrados en la Base de Datos.
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
                    <th>Nombres Completos</th>
                    <th>Usuario</th>
                    <th>Area</th>
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
        delete_persona();

    });
   function datatable() {
       $('#datatable-responsive').DataTable( {
           "destroy":true,
           "processing": true,
           "serverSide": true,
           "ajax": "getPersonal",
           "columns":[
               {data:'id'},
               {data:'ncompletos'},
               {data:'username'},
               {data:'area'},
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
               var dato=$("#nombre").val();
               var dato2=$("#apellidoPat").val();
               var dato3=$("#apellidoMat").val();
               var dato4=$("#area_id").val();
               var dato5=$("#user_id").val();
               var dato6=$("#email").val();
               var dato7=$("#estado").val();
               $.ajax({
                   url: 'personal',
                   headers: { 'X-CSRF-Token' : token },
                   type: 'POST',
                   dataType: 'json',
                   data: {nombre: dato,
                       apellidoPat:dato2,
                       apellidoMat:dato3,
                       area_id:dato4,
                       user_id:dato5,
                       email:dato6,
                       estado:dato7
                   },
                   success: function(data){
                       datatable();
                       $("#myModal").modal('toggle');
                       toastr.success('Personal: '+data.mensaje+' a sido registrado', {timeOut: 5000});
                           vm.nombre='';
                           vm.apellidoPat='';
                           vm.apellidoMat='';
                           vm.area='';
                           vm.usuario= '';
                           vm.email='';
                           vm.estado='';

                   },
                   error: function(data){
                       $("#myModal").modal('toggle');
                       var errors = '';
                       for(datos in data.responseJSON){
                           errors += '* '+data.responseJSON[datos] + '<br>';
                       }
                       toastr.error(errors, {timeOut: 5000});
                       //console.log(data);
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
   function actualizar() {
       var token = $("#token").val();
       $("#form_actualizar").on('submit', function(e){
           e.preventDefault();
           var form = $(this);
           var bool=form.parsley().validate();
           if(bool){
               var dato=$("#nombre2").val();
               var dato2=$("#apellidoPat2").val();
               var dato3=$("#apellidoMat2").val();
               var dato4=$("#area_id2").val();
               var dato5=$("#user_id2").val();
               var dato6=$("#email2").val();
               var dato7=$("#estado2").val();
               var id= $("#id_actualizar").val();
               $.ajax({
                   url: "personal/"+id+"",
                   headers: { 'X-CSRF-Token' : token },
                   type: 'PUT',
                   dataType: 'json',
                   data: {nombre: dato,
                       apellidoPat:dato2,
                       apellidoMat:dato3,
                       area_id:dato4,
                       user_id:dato5,
                       email:dato6,
                       estado:dato7
                   },
                   success: function(data1){
                       datatable();
                       $("#myModal2").modal('toggle');
                       toastr.success('Personal: '+data1.mensaje+' a sido actualizado', {timeOut: 5000});
                       vm.cambio1=false;
                       vm.cambio2=false;
                       vm.cambio3=false;
                       vm.cambio4=false;
                       vm.cambio5=false;
                       vm.cambio6=false;
                       vm.cambio7=false;
                   },
                   error: function(data1){
                       $("#myModal2").modal('toggle');
                       var errors = '';
                       for(datos in data1.responseJSON){
                           errors += '* '+data1.responseJSON[datos] + '<br>';
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
    function Mostrar(btn){
        $.get("personal/"+btn.value+"/edit", function(res){
            $("#nombre2").val(res.nombre);
            $("#apellidoPat2").val(res.apellidoPat);
            $("#apellidoMat2").val(res.apellidoMat);
            $("#area_id2").val(res.area_id);
            $("#user_id2").val(res.user_id);
            $("#email2").val(res.email);
            $("#estado2").val(res.estado);

            $("#id_actualizar").val(btn.value);

            $("#id_o_nombre").val(res.nombre);
            $("#id_o_apellidoPat").val(res.apellidoPat);
            $("#id_o_apellidoMat").val(res.apellidoMat);
            $("#id_o_area").val(res.area_id);
            $("#id_o_user").val(res.user_id);
            $("#id_o_email").val(res.email);
            $("#id_o_estado").val(res.estado);

        });
    }
    function Ver(btn){

        $.getJSON("personal/"+btn.value+"/edit2",function (result) {
            $.each(result, function(i, res){
                var estado=res.estado;
                $("#nombre5").text(res.nombre);
                $("#apellidoPat5").text(res.apellidoPat);
                $("#apellidoMat5").text(res.apellidoMat);
                $("#area5").text(res.area);
                $("#username5").text(res.username);
                $("#email5").text(res.email);

                if(estado==1){$("#estado5").text('Activo');}
                else {$("#estado5").text('Suspendido');};

                $("#id").val(btn.value);
            });


        })
    }

    function Eliminar(btn){

        $.get("personal/"+btn.value+"/edit", function(res){
            $("#id_persona").val(btn.value);
            $("#persona_nombre").html(res.nombre+' '+res.apellidoPat+' '+res.apellidoMat);
        });
    }
    function delete_persona() {
        $("#form_eliminar").on('submit', function(e){
            var value = $("#id_persona").val();
            var token = $("#token2").val();
            e.preventDefault();
            $.ajax({
                url:"personal/"+value+"",
                headers: { 'X-CSRF-Token' : token },
                type: 'DELETE',
                dataType: 'json',

                success: function(data3){
                    datatable();
                    $("#myModal9").modal('toggle');
                    toastr.warning('La Persona ha sido eliminado de la BD '+data3.mensaje, {timeOut: 5000});

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
            nombre:'',
            apellidoPat:'',
            apellidoMat:'',
            area:'',
            usuario: '',
            email:'',
            estado:'',

            cambio1:false,
            cambio2:false,
            cambio3:false,
            cambio4:false,
            cambio5:false,
            cambio6:false,
            cambio7:false,

        },
        computed:{
            activando: function () {
                return this.nombre && this.apellidoPat && this.apellidoMat && this.area && this.usuario && this.email && this.estado;
            },
            activando2: function () {
                return this.cambio1 || this.cambio2  || this.cambio3 || this.cambio4 || this.cambio5 || this.cambio6 || this.cambio7;
            }

        },
        watch: {

        },
        methods: {
            changeNombre:function (event) {
                if($("#id_o_nombre").val().toLowerCase()==event.target.value.toLowerCase()){
                    this.cambio1=false;
                }else {this.cambio1=true;}

            },
            changeApellidoPat:function (event) {
                if($("#id_o_apellidoPat").val().toLowerCase()==event.target.value.toLowerCase()){
                    this.cambio2=false;
                }else {this.cambio2=true;}

            },
            changeApellidoMat:function (event) {
                if($("#id_o_apellidoMat").val().toLowerCase()==event.target.value.toLowerCase()){
                    this.cambio3=false;
                }else {this.cambio3=true;}

            },
            changeArea:function (event) {
                if($("#id_o_area").val()==event.target.value){
                    this.cambio4=false;
                }else {this.cambio4=true;}

            },
            changeUser:function (event) {
                if($("#id_o_user").val()==event.target.value){
                    this.cambio5=false;
                }else {this.cambio5=true;}

            },
            changeEmail:function (event) {
                if($("#id_o_email").val().toLowerCase()==event.target.value.toLowerCase()){
                    this.cambio6=false;
                }else {this.cambio6=true;}

            },
            changeEstado:function (event) {
                if($("#id_o_estado").val()==event.target.value){
                    this.cambio7=false;
                }else {this.cambio7=true;}

            },
            cancelarCrear:function(){
                this.nombre="";
                this.apellidoPat="";
                this.apellidoMat="";
                this.area="";
                this.usuario="";
                this.email="";
                this.estado="";
            },
            cancelarActualizar:function(){
                this.cambio1=false;
                this.cambio2=false;
                this.cambio3=false;
                this.cambio4=false;
                this.cambio5=false;
                this.cambio6=false;
                this.cambio7=false;
            },

        }

    });


</script>
<!--<script src="{{ asset('js/personal_vue.js') }}"></script> -->
@endpush