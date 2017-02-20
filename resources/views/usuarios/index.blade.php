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

@include('usuarios.modalCrearUsuario')
@include('usuarios.modalActualizarUsuario')
@include('usuarios.modalVer')
@include('usuarios.modalEliminarUsuario')

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
                    <th>Nombre de Usuario</th>
                    <th>Tipo Usuario</th>
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
        delete_user();

    });
   function datatable() {
       $('#datatable-responsive').DataTable( {
           "destroy":true,
           "processing": true,
           "serverSide": true,
           "ajax": "getUser",
           "columns":[
               {data:'id'},
               {data:'username'},
               {data:'tipousuario'},
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
               var dato = $("#tipousuario_id").val();
               var dato2 = $("#username").val();
               var dato4=$('#password').val();
               var dato3 = $("#estado").val();
               $.ajax({
                   url: 'usuarios',
                   headers: { 'X-CSRF-Token' : token },
                   type: 'POST',
                   dataType: 'json',
                   data: {tipousuario_id: dato,
                          username:dato2,
                          password:dato4,
                          estado:dato3
                   },
                   success: function(data){
                       datatable();
                       $("#myModal").modal('toggle');
                       toastr.success('Usuario: '+data.mensaje+' a sido registrado', {timeOut: 5000});
                       //$("#tipousuario_id").val('');
                       //$("#username").val('');
                       //$('#password').val('');
                       //$('#password_confirmation').val('');
                       //$("#estado").val('');
                        vm.tipo_user='';
                        vm.contra='';
                        vm.confircontra='';
                        vm.estado='';
                        vm.nombreusuario='';


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
       var token = $("#token").val();
       $("#form_actualizar").on('submit', function(e){
           e.preventDefault();
           var form = $(this);
           var bool=form.parsley().validate();
           if(bool){
               var dato = $("#tipousuario_id2").val();
               var dato2 = $("#username2").val();
               var dato4=$('#password2').val();
               var dato3 = $("#estado2").val();
               var id= $("#id_actualizar").val();
               $.ajax({
                   url: "usuarios/"+id+"",
                   headers: { 'X-CSRF-Token' : token },
                   type: 'PUT',
                   dataType: 'json',
                   data: {tipousuario_id: dato,
                       username:dato2,
                       password:dato4,
                       estado:dato3
                   },
                   success: function(data1){
                       datatable();
                       $("#myModal2").modal('toggle');
                       toastr.success('Usuario: '+data1.mensaje+' a sido actualizado', {timeOut: 5000});
                       vm.cambio1=false;
                       vm.cambio2=false;
                       vm.cambio3=false;
                       vm.cambio4=false;
                       vm.cambio5=false;
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

        $.get("usuarios/"+btn.value+"/edit", function(res){
            $("#tipousuario_id2").val(res.tipousuario_id);
            $("#username2").val(res.username);
            $("#estado2").val(res.estado);
            $("#id_actualizar").val(btn.value);

            $("#id_o_tipousuario").val(res.tipousuario_id);
            $("#id_o_username").val(res.username);
            $("#id_o_estado").val(res.estado);

        });
    }
    function Ver(btn){

        $.get("usuarios/"+btn.value+"/edit", function(res){
            var estado=res.estado;
            var tipousuario=res.tipousuario_id;
            $("#username5").text(res.username);

            if(estado==1){$("#estado5").text('Activo');}
            else {$("#estado5").text('Suspendido');};

            if(tipousuario==1){
                $("#tipousuario_id5").text('Administrador');
            }else{
                if(tipousuario==2){ $("#tipousuario_id5").text('Operario');}
                else{$("#tipousuario_id5").text('Mecanico');}

            };

            $("#id_ver").val(btn.value);
        });
    }

    function Eliminar(btn){

        $.get("usuarios/"+btn.value+"/edit", function(res){
            $("#id_user_eliminar").val(btn.value);
            $("#username_user").html(res.username);
        });
    }
    function delete_user() {
        $("#form_eliminar").on('submit', function(e){
            var value = $("#id_user_eliminar").val();
            var token = $("#token2").val();
            e.preventDefault();
            $.ajax({
                url:"usuarios/"+value+"",
                headers: { 'X-CSRF-Token' : token },
                type: 'DELETE',
                dataType: 'json',

                success: function(data3){
                    datatable();
                    $("#myModal9").modal('toggle');
                    toastr.warning('Usuario ha sido eliminado '+data3.mensaje, {timeOut: 5000});

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
            tipo_user:'',
            contra:'',
            confircontra:'',
            estado:'',
            nombreusuario: '',
            cambio1:false,
            cambio2:false,
            cambio3:false,
            cambio4:false,
            cambio5:false,

        },
        computed:{
            activando: function () {
                return this.nombreusuario && this.tipo_user  && this.contra && this.confircontra && this.estado ;
            },
            activando2: function () {
                return this.cambio1 || this.cambio2  || this.cambio3 || this.cambio4 || this.cambio5  ;
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
            changeTipousuario:function (event) {
                if($("#id_o_tipousuario").val()==event.target.value){
                    this.cambio1=false;
                }else {this.cambio1=true;}

            },
            changeUsername:function (event) {
                if($("#id_o_username").val().toLowerCase()==event.target.value.toLowerCase()){
                    this.cambio2=false;
                }else {this.cambio2=true;}

            },
            changePassword:function (event) {
                if(event.target.value==''){
                    this.cambio3=false;
                }else {this.cambio3=true;}

            },
            changeRepassword:function (event) {
                if(event.target.value==''){
                    this.cambio4=false;
                }else {this.cambio4=true;}

            },
            changeEstado:function (event) {
                if($("#id_o_estado").val()==event.target.value){
                    this.cambio5=false;
                }else {this.cambio5=true;}

            },
            cancelarCrear:function(){
                this.tipo_user="";
                this.contra="";
                this.confircontra="";
                this.estado="";
                this.nombreusuario="";
            },
            cancelarActualizar:function(){
                this.cambio1=false;
                this.cambio2=false;
                this.cambio3=false;
                this.cambio4=false;
                this.cambio5=false;
            },

        }

    });


</script>
<!--<script src="{{ asset('js/user_vue.js') }}"></script> -->
@endpush