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


@include('areas.modalCrearArea')
@include('areas.modalActualizarArea')
@include('areas.modalVer')
@include('areas.modalEliminarArea')

<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">Usuarios</h4>
    </div>
</div>
<!-- Page-Title -->


<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>Lista de Areas</b></h4>
            <p class="text-muted font-13 m-b-30">
                Areas registradas en la Base de Datos.
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
        delete_area();

    });
   function datatable() {
       $('#datatable-responsive').DataTable( {
           "destroy":true,
           "processing": true,
           "serverSide": true,
           "ajax": "getArea",
           "columns":[
               {data:'id'},
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
               var dato = $("#area").val();

               $.ajax({
                   url: 'areas',
                   headers: { 'X-CSRF-Token' : token },
                   type: 'POST',
                   dataType: 'json',
                   data: {area: dato,

                   },
                   success: function(data){
                       datatable();
                       $("#myModal").modal('toggle');
                       toastr.success('Area: '+data.mensaje+' a sido registrada', {timeOut: 5000});
                       $("#area").val('');


                   },
                   error: function(data){
                       $("#myModal").modal('toggle');
                       var errors = '';
                       for(datos in data.responseJSON){
                           errors += '* '+data.responseJSON[datos] + '<br>';
                       }
                       toastr.error(errors, {timeOut: 5000});
                       console.log(data);
                   }
               });
               //$("#myModal").modal('toggle');
               //toastr.error('Registrado Correctamente', {timeOut: 5000});
           }else{
               $("#myModal").modal('toggle');
               toastr.error('Datos no validos', {timeOut: 5000});
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
               var dato = $("#area2").val();

               var id= $("#id_actualizar").val();
               $.ajax({
                   url: "areas/"+id+"",
                   headers: { 'X-CSRF-Token' : token },
                   type: 'PUT',
                   dataType: 'json',
                   data: {area: dato
                   },
                   success: function(data1){
                       datatable();
                       $("#myModal2").modal('toggle');
                       toastr.success('Area: '+data1.mensaje+' a sido actualizada', {timeOut: 5000});

                   },
                   error: function(data1){
                       $("#myModal2").modal('toggle');
                       var errors = '';
                       for(datos in data1.responseJSON){
                           errors += '* '+data1.responseJSON[datos] + '<br>';
                       }
                       toastr.error(errors, {timeOut: 5000});
                       console.log(data1);
                   }
               });

           }else{

               //$("#myModal").modal('toggle');
               toastr.success('Datos no validos', {timeOut: 5000});
           }
       });
   }
    function Mostrar(btn){
        $.get("areas/"+btn.value+"/edit", function(res){
            $("#area2").val(res.area);
            $("#id_actualizar").val(btn.value);
            $("#id_o_area").val(res.area);

        });
    }
    function Ver(btn){
        $.get("areas/"+btn.value+"/edit", function(res){
            $("#area5").text(res.area);
            $("#id_ver").val(btn.value);
        });
    }

    function Eliminar(btn){

        $.get("areas/"+btn.value+"/edit", function(res){
            $("#id_area_eliminar").val(btn.value);
            $("#area_areas").html(res.area);
        });
    }
    function delete_area() {
        $("#form_eliminar").on('submit', function(e){
            var value = $("#id_area_eliminar").val();
            var token = $("#token2").val();
            e.preventDefault();
            $.ajax({
                url:"areas/"+value+"",
                headers: { 'X-CSRF-Token' : token },
                type: 'DELETE',
                dataType: 'json',

                success: function(data3){
                    datatable();
                    $("#myModal9").modal('toggle');
                    toastr.warning('El Area ha sido eliminada '+data3.mensaje, {timeOut: 5000});

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
            area: '',
            cambio1:false,
        },
        computed:{
            activando: function () {
                return this.area ;
            },
            activando2: function () {
                return this.cambio1;
            }

        },
        watch: {

        },
        methods: {

            changeArea:function (event) {
                if($("#id_o_area").val().toLowerCase()==event.target.value.toLowerCase()){
                    this.cambio1=false;
                }else {this.cambio1=true;}

            },
            cancelarCrear:function () {
                this.area="";
            },
            cancelarActualizar:function () {
                 this.cambio1=false;
            },
        }

    });



</script>
<!-- <script src="{{ asset('js/area_vue.js') }}"></script> -->
@endpush