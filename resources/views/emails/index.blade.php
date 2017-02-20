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


    <div class="row">

        <div class="col-lg-8 col-lg-offset-2">
            <ul class="nav nav-tabs navtab-custom nav-justified">
                <li class="active">
                    <a href="#home1" data-toggle="tab" aria-expanded="true">
                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                        <span class="hidden-xs">Crear Mensaje</span>
                    </a>
                </li>
                <li class="">
                    <a href="#profile1" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="fa fa-user"></i></span>
                        <span class="hidden-xs">Profile</span>
                    </a>
                </li>
                <li class="">
                    <a href="#messages1" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                        <span class="hidden-xs">Messages</span>
                    </a>
                </li>
                <li class="">
                    <a href="#settings1" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="fa fa-cog"></i></span>
                        <span class="hidden-xs">Settings</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content ">
                <div class="tab-pane active" id="home1">
                    <form id="form_registrar" class="form-horizontal" action="{{url('admin/enviarCorreo')}}" method="POST"  data-parsley-validate novalidate>

                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label for="username" class="col-sm-4 control-label">Destino*</label>
                                <div class="col-sm-6">
                                    <input type="email" id="destino" required  data-parsley-minlength="6" class="form-control"  name="destino" >

                                </div>
                            </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-4 control-label">Asunto*</label>
                            <div class="col-sm-6">
                                <input type="text" id="asunto" required  data-parsley-minlength="6" class="form-control"  name="asunto" >

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username" class="col-sm-4 control-label">Mensaje*</label>
                            <div class="col-sm-6">
                                <textarea name="mensaje" required class="form-control">

                                </textarea>

                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-sm-6 col-lg-offset-4">
                                <button class="form-control btn btn-primary" id="enviar">
                                    Enviar
                                </button>

                            </div>
                        </div>


                    </form>
                </div>
                <div class="tab-pane" id="profile1">

                </div>
                <div class="tab-pane" id="messages1">

                </div>
                <div class="tab-pane" id="settings1">


                </div>
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
        //parsley();
        //datatable();
        //actualizar();
        //delete_user();

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
                       $("#tipousuario_id").val('');
                       $("#username").val('');
                       $('#password').val('');
                       $('#password_confirmation').val('');
                       $("#estado").val('');

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

                   },
                   error: function(data1){
                       $("#myModal2").modal('toggle');
                       var errors = '';
                       for(datos in data1.responseJSON){
                           errors += '* '+data.responseJSON[datos] + '<br>';
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
            $("#id_actualizar").val(res.id);

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

            $("#id_ver").val(res.id);
        });
    }

    function Eliminar(btn){

        $.get("usuarios/"+btn.value+"/edit", function(res){
            $("#id_user_eliminar").val(res.id);
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




</script>
<script src="{{ asset('js/user_vue.js') }}"></script>
@endpush