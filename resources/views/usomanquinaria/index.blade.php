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
@include('usomanquinaria.modalCrearUsoMaquinaria')
@include('usomanquinaria.modalVer')



<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>Lista de Reportes </b></h4>
            <p class="text-muted font-13 m-b-30">
                Reportes de uso de la maquinaria registrado en la Base de Datos.
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
                    <th>Detalle</th>
                    <th>Fecha</th>
                    <th>Horometro Inicial</th>
                    <th>Horometro Final</th>
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
        //actualizar();
        //delete_user();

    });
   function datatable() {
       $('#datatable-responsive').DataTable( {
           "destroy":true,
           "processing": true,
           "serverSide": true,
           "ajax": "getReportes",
           "columns":[
               {data:'id'},
               {data:'detalle'},
               {data:'created_at'},
               {data:'inicial_horometro'},
               {data:'final_horometro'},
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
               var dato = $("#detalle").val();
               var dato2 = $("#hora_Inicial").val();
               var dato3=$('#hora_Final').val();
               var dato4 = $("#inicial_horometro").val();
               var dato5 = $("#final_horometro").val();
               $.ajax({
                   url: 'asignado',
                   headers: { 'X-CSRF-Token' : token },
                   type: 'POST',
                   dataType: 'json',
                   data: {detalle: dato,
                       hora_Inicial:dato2,
                       hora_Final:dato3,
                       inicial_horometro:dato4,
                       final_horometro:dato5
                   },
                   success: function(data){

                       datatable();
                       $("#myModal").modal('toggle');
                       toastr.success('Reporte: '+data.mensaje+' a sido registrado', {timeOut: 5000});
                       /*
                       $("#tipousuario_id").val('');
                       $("#username").val('');
                       $('#password').val('');
                       $('#password_confirmation').val('');
                       $("#estado").val('');*/

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
            $("#id_actualizar").val(btn.value);

            $("#id_o_tipousuario").val(res.tipousuario_id);
            $("#id_o_username").val(res.username);
            $("#id_o_estado").val(res.estado);

        });
    }
    function Ver(btn){

        $.get("reporteUso/"+btn.value+"/edit", function(res){

            $("#detalle2").text(res.detalle);
            $("#fecha").text(res.created_at);
            $("#hora_Inicial2").text(res.hora_Inicial);
            $("#hora_Final2").text(res.hora_Final);
            $("#inicial_horometro2").text(res.inicial_horometro);
            $("#final_horometro2").text(res.final_horometro);

            $("#id_ver").val(btn.value);
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

    var vm=new Vue({

        el:'#my_app',
        data:{
            detalle:'',
            hora_Inicial:'',
            hora_Final:'',
            inicial_horometro:'',
            final_horometro: '',
            cambio1:false,
            cambio2:false,
            cambio3:false,
            cambio4:false,
            cambio5:false,

        },
        computed:{
            activando: function () {
                return this.detalle && this.hora_Inicial && this.hora_Final && this.inicial_horometro>0 && this.final_horometro>0 ;
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
                this.detalle="";
                this.hora_Inicial="";
                this.hora_Final="";
                this.inicial_horometro="";
                this.final_horometro="";
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
<!--<script src="{{ asset('js/usomaquinaria_vue.js') }}"></script> -->
@endpush