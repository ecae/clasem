@extends('layouts.original')
@push('css')

<link rel="stylesheet" href="{{ asset('tema1/css/bootstrap.min.css') }}" />

@endpush
@section('content')



<!-- Page-Title -->


<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>Detalle de la Maquinaria</b></h4>
            <p class="text-muted font-13 m-b-30">
                Maquinaria asignada.
            </p>

            <div class="row">
                @foreach($asignados as $asignado)
                <div class="col-sm-8 ">
                    <div class="form-group">
                        <img id="img" src="{{ asset('img/maquinaria') }}/{{$asignado->path}}" class=" form-control img-rounded" style="height: 400px">
                    </div>
                </div>
                <div class="clearfix visible-xs"></div>
                <div class="col-sm-4">

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Descripcion:</label>
                        <br>
                        <label id="fabricante1" name="fabricante" class="form-control">{{$asignado->descripcion}}</label>
                        <br>
                        <label for="marca" class="col-sm-4 control-label">Marca:</label>
                        <br>
                        <label id="marca1" name="marca" class="form-control">{{$asignado->marca}}</label>
                        <br>
                        <label for="modelo" class="col-sm-4 control-label">Modelo:</label>
                        <br>
                        <label id="modelo1" name="modelo" class="form-control">{{$asignado->modelo}}</label>
                        <br>
                        <label for="serie" class="col-sm-4 control-label">Serie:</label>
                        <br>
                        <label id="serie1" name="serie" class="form-control">{{$asignado->serie}}</label>
                        <br>
                        <label for="fechacompra" class="col-sm-12 control-label">Fecha de Compra:</label>
                        <br>
                        <!--<input type="datetime" required parsley-type="text" class="form-control" id="fechacompra" name="fechacompra"  placeholder="Fecha de compra">-->
                        <label id="fechacompra1" name="fechacompra" class="form-control">{{$asignado->fechacompra}}</label>
                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


@endsection
@section('js')

@endsection
@push('scripts')

@endpush