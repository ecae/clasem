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
    <div class="col-sm-12">
        <div class="card-box ">

            <h4 class="m-t-0 header-title"><b>Historial de Mantenimientos Realizados</b></h4>
            <p class="text-muted font-13 m-b-30">
                Historial de los mantenimientos que se han realizado.
            </p>
            <div class="row">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

            </div>
            <!--
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr >
                    <th>ID</th>
                    <th>Mantenimiento</th>
                    <th>Equipo</th>
                    <th>Ultimo Horometro</th>
                    <th>Limite Horometro</th>
                    <th>Fecha de Mant.</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            -->
            <ul class="nav nav-pills m-b-30">
                <li class="active">
                    <a href="#navpills-11" data-toggle="tab" aria-expanded="true">Mantenimientos</a>
                </li>
                <li class="">
                    <a href="#navpills-21" data-toggle="tab" aria-expanded="false">MTTO Realizado por Interno</a>
                </li>
                <li class="">
                    <a href="#navpills-31" data-toggle="tab" aria-expanded="false">MTTO Realizado por Proveedor</a>
                </li>
            </ul>
            <div class="tab-content br-n pn">
                <div id="navpills-11" class="tab-pane active">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="datatable-mantenimientos" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr >
                                    <th>ID</th>
                                    <th>Mantenimiento</th>
                                    <th>Equipo</th>
                                    <th>Limite Horometro</th>
                                    <th>Fecha de Inicial.</th>
                                    <th>Fecha de Mant.</th>
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
                                    <th>Equipo</th>
                                    <th>Modalidad</th>
                                    <th>Operador</th>
                                    <th>Costo S/.</th>
                                    <th>Observacion</th>
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
                                    <th>Equipo</th>
                                    <th>Razon Social</th>
                                    <th>Operador</th>
                                    <th>Costo S/.</th>
                                    <th>Observacion</th>
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
        datatable_mantenimientos();
        datatable_interno();
        datatable_proveedor();
    });
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
                {data:'fecha_mantenimiento'}
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
                {data:'costo'},
                {data:'observacion'}
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
                {data:'costo'},
                {data:'observacion'}
            ]
        } );

    }
</script>
@endpush