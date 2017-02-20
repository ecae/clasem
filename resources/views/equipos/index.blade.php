@extends('layouts.original')
@push('css')
<link rel="stylesheet" href="{{ asset('tema1/css/bootstrap-datepicker.min.css') }}" />

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

@include('equipos.modalCrearEquipo')
@include('equipos.modalActualizarEquipo')
@include('equipos.modalVer')
@include('equipos.modalEliminarEquipo')



<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">Maquinaria</h4>
    </div>
</div>
<!-- Page-Title -->


<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>Lista de las Maquinarias</b></h4>
            <p class="text-muted font-13 m-b-30">
                Maquinaria registrada en la Base de Datos.
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
                    <th>FABRICANTE</th>
                    <th>MARCA</th>
                    <th>MODELO</th>
                    <th>DESCRIPCION</th>
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
    <script src="{{ asset('tema1/js/bootstrap-datepicker.min.js') }}"></script>

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
        delete_maquinaria();

    });
   function datatable() {
       $('#datatable-responsive').DataTable( {
           "destroy":true,
           "processing": true,
           "serverSide": true,
           "ajax": "getEquipos",
           "columns":[
               {data:'id'},
               {data:'fabricante'},
               {data:'marca'},
               {data:'modelo'},
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

               $.ajax({
                   url: 'equipos',
                   headers: { 'X-CSRF-Token' : token },
                   type: 'POST',
                   dataType: 'json',
                   data:new FormData($("#form_registrar")[0]),
                   contentType: false,
                   processData: false,
                   success: function(data){
                       datatable();
                       $("#myModal").modal('toggle');
                       toastr.success('Maquinaria: '+data.mensaje+' a sido registrada', {timeOut: 5000});
                       $("#fabricante").val('');
                       $("#marca").val('');
                       $("#modelo").val('');
                       $("#fechacompra").val('');
                       $("#serie").val('');
                       $("#descripcion").val('');
                       $("#foto").val('');
                       $("#estado").val('');

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

       $("#form_actualizar").on('submit', function(e){
           e.preventDefault();
           var form = $(this);
           var bool=form.parsley().validate();
           if(bool){
               var id= $("#id_actualizar").val();
               $.ajax({
                   url: "update2/"+id+"",
                   headers: { 'X-CSRF-Token' : token },
                   type: 'POST',
                   dataType: 'json',
                   data:new FormData($("#form_actualizar")[0]),
                   contentType: false,
                   processData: false,
                   success: function(data1){
                       datatable();
                       $("#myModal2").modal('toggle');
                       toastr.success('Maquinaria: '+data1.mensaje+' a sido actualizada', {timeOut: 5000});

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

        $.get("equipos/"+btn.value+"/edit", function(res){
            //var from =(res.fechacompra).split("-");
            //var f=from[2]+"/"+from[1]+"/"+from[0];

            $("#fabricante2").val(res.fabricante);
            $("#marca2").val(res.marca);
            $("#modelo2").val(res.modelo);
            $("#serie2").val(res.serie);
            $("#descripcion2").val(res.descripcion);
            $("#fechacompra2").val(res.fechacompra);
            $("#estado2").val(res.estado);

            $("#id_actualizar").val(btn.value);

            $("#id_o_fabricante").val(res.fabricante);
            $("#id_o_marca").val(res.marca);
            $("#id_o_modelo").val(res.modelo);
            $("#id_o_serie").val(res.serie);
            $("#id_o_descripcion").val(res.descripcion);
            $("#id_o_fecha").val(res.fechacompra);
            $("#id_o_foto").val(res.path);
            $("#id_o_estado").val(res.estado);


        });
    }
    function Ver(btn){

            $.get("equipos/"+btn.value+"/edit", function(res){
                $("#fabricante1").text(res.fabricante);
                $("#marca1").text(res.marca);
                $("#modelo1").text(res.modelo);
                $("#serie1").text(res.serie);
                $("#fechacompra1").text(res.fechacompra);
                $("#img" ).attr( "src",'{{ asset('img/maquinaria') }}/'+res.path )


            });
    }

    function Eliminar(btn){

        $.get("equipos/"+btn.value+"/edit", function(res){
            $("#id_equipo").val(btn.value);
            $("#equipo_nombre").html(res.descripcion);
        });
    }
    function delete_maquinaria() {
        $("#form_eliminar").on('submit', function(e){
            var value = $("#id_equipo").val();
            var token = $("#token2").val();
            e.preventDefault();
            $.ajax({
                url:"equipos/"+value+"",
                headers: { 'X-CSRF-Token' : token },
                type: 'DELETE',
                dataType: 'json',

                success: function(data3){
                    datatable();
                    $("#myModal9").modal('toggle');
                    toastr.warning('La Maquinaria ha sido eliminada de la BD '+data3.mensaje, {timeOut: 5000});

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


   var vm= new Vue({

        el:'#my_app',
        data:{
            fabricante:'',
            marca:'',
            modelo:'',
            descripcion:'',
            serie: '',
            fechacompra:'',
            path:'',
            estado:'',
            fechacompra2:'',
            cambio1:false,
            cambio2:false,
            cambio3:false,
            cambio4:false,
            cambio5:false,
            cambio6:false,
            //cambio7:false,
            cambio8:false,

        },
        computed:{
            activando: function () {
                return this.fabricante && this.marca && this.modelo && this.descripcion && this.serie && this.fechacompra && this.estado && this.path;
            },
            activando2: function () {
                return this.cambio1 || this.cambio2 || this.cambio3 || this.cambio4 || this.cambio5 || this.cambio6 || this.path || this.cambio8;
            },
        },
        watch: {

        },
        methods: {

             changeFabricante:function (event) {
             if($("#id_o_fabricante").val().toLowerCase()==event.target.value.toLowerCase()){
             this.cambio1=false;
             }else {this.cambio1=true;}

             },
             changeMarca:function (event) {
             if($("#id_o_marca").val().toLowerCase()==event.target.value.toLowerCase()){
             this.cambio2=false;
             }else {this.cambio2=true;}

             },
             changeModelo:function (event) {
             if($("#id_o_modelo").val().toLowerCase()==event.target.value.toLowerCase()){
             this.cambio3=false;
             }else {this.cambio3=true;}

             },
             changeSerie:function (event) {
                 if($("#id_o_serie").val().toLowerCase()==event.target.value.toLowerCase()){
                     this.cambio4=false;
                 }else {this.cambio4=true;}

             },
             changeDescripcion:function (event) {
                 if($("#id_o_descripcion").val().toLowerCase()==event.target.value.toLowerCase()){
                     this.cambio5=false;
                 }else {this.cambio5=true;}
             },
            changeFecha:function (event) {
                if($("#id_o_fecha").val()==event.target.value){
                    this.cambio6=false;
                }else {this.cambio6=true;}

            },
            changePath: function (event) {
                this.path = event.target.value.split('\\').pop();
                //var data = new FormData($("#form_registrar")[0]);
                //this.cambio7 = true;

            },
             changeEstado:function (event) {
             if($("#id_o_estado").val()==event.target.value){
             this.cambio8=false;
             }else {this.cambio8=true;}

             },

            cancelarCrear:function () {
                    this.fabricante='';
                    this.marca='';
                    this.modelo='';
                    this.descripcion='';
                    this.serie='';
                    this.fechacompra='';
                    this.path='';
                    this.estado='';
            },
            cancelarActualizar:function () {
                this.cambio1='';
                this.cambio2='';
                this.cambio3='';
                this.cambio4='';
                this.cambio5='';
                this.cambio6='';
                this.path='';
                this.cambio8='';
            }
        }

    });





</script>
<!--<script src="{{ asset('js/maquinaria_vue.js') }}"></script> -->
@endpush