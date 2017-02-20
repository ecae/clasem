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

@include('ordenTrabajo.modalCrearOrdenTrabajo')
@include('ordenTrabajo.modalActualizarOrdenTrabajo')
@include('ordenTrabajo.modalEliminarOrdenTrabajo')

<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>Lista de las &Oacute;rdenes de Trabajo</b></h4>
            <p class="text-muted font-13 m-b-30">
                &Oacute;rdenes de Trabajo registrada en la Base de Datos.
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
                    <th>FECHA</th>
                    <th>MAQUINARIA</th>
                    <th>MANTENIMIENTO</th>
                    <th>L.AVERÍA</th>
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
        cerrarModalActualizar();
        cerrarModalcrear();
        delete_maquinaria();


    });
    function cerrarModalActualizar(){
        $('#myModal2').on('hidden.bs.modal', function () {
            $(this).find("input,textarea,select").val('').end();
            $( "#Addtemplate_Actualizar" ).empty();
        });

    }
    function cerrarModalcrear() {
        $('#myModal').on('hidden.bs.modal', function () {
            $(this).find("input,textarea,select").val('').end();
            $( "#Addtemplate" ).empty();
            vm.maquinaria_id='';
            vm.kilometraje=0;
            vm.horometro=0;
            vm.loca_averia='';
            vm.tipo_mantenimiento= '';
            vm.descripcion_trabajo='';
            vm.duracion_tarea=0;
            vm.can_personal=0;
            vm.cod_material='';
            vm.cantidad=0;
            vm.observacion='';
            vm.idAddMantenimiento='0';
            vm.negativoDuracionTrabajo=false;
            vm.negativoCantidadPersonal=false;
            vm.negativoCantidad=false;
        });
    }
    function datatable() {
       $('#datatable-responsive').DataTable( {
           "destroy":true,
           "processing": true,
           "serverSide": true,
           "ajax": "getOrdenTrabajo",
           "columns":[
               {data:'id'},
               {data:'fecha'},
               {data:'nombre_maquinaria'},
               {data:'tipo_mtto'},
               {data:'localizacion_averia'},
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
           var idAddMantenimiento=vm.idAddMantenimiento;
           if(bool) {
               if (idAddMantenimiento > 0) {
                   var concaDescMante = vm.descripcion_trabajo;
                   var concaDuracionTarea = vm.duracion_tarea;
                   var concaCanPersonal = vm.can_personal;
                   var concaCodMaterial = vm.cod_material;
                   var concaCantidad = vm.cantidad;
                   for (var i = 1; i <= idAddMantenimiento; i++) {
                       if ($("#descripcion_trabajo" + i).val() != undefined) {
                           concaDescMante = concaDescMante + ' -' + $("#descripcion_trabajo" + i).val();
                       }
                       if ($("#duracion_tarea" + i).val() != undefined) {
                           concaDuracionTarea = concaDuracionTarea + ' -' + $("#duracion_tarea" + i).val();
                       }
                       if ($("#can_personal" + i).val() != undefined) {
                           concaCanPersonal = concaCanPersonal + ' -' + $("#can_personal" + i).val();
                       }
                       if ($("#cod_material" + i).val() != undefined) {
                           concaCodMaterial = concaCodMaterial + ' -' + $("#cod_material" + i).val();
                       }
                       if ($("#cantidad" + i).val() != undefined) {
                           concaCantidad = concaCantidad + ' -' + $("#cantidad" + i).val();
                       }
                   }
                   $.ajax({
                       url: 'ordenTrabajo',
                       headers: {'X-CSRF-Token': token},
                       type: 'POST',
                       dataType: 'json',
                       data: {
                           maquinaria_id: vm.maquinaria_id,
                           kilometraje: vm.kilometraje,
                           horometro: vm.horometro,
                           loca_averia: vm.loca_averia,
                           tipo_mantenimiento: vm.tipo_mantenimiento,
                           descripcion_trabajo: concaDescMante,
                           duracion_tarea: concaDuracionTarea,
                           cantidad_personal: concaCanPersonal,
                           codigo_material: concaCodMaterial,
                           cantidad: concaCantidad,
                           observacion: vm.observacion
                       },
                       success: function (data) {
                           datatable();
                           $("#myModal").modal('toggle');
                           toastr.success('Maquinaria: ' + data.mensaje + ' a sido registrada', {timeOut: 5000});
                           $( "#Addtemplate" ).empty();
                           vm.maquinaria_id = '';
                           vm.kilometraje = 0;
                           vm.horometro = 0;
                           vm.loca_averia = '';
                           vm.tipo_mantenimiento = '';
                           vm.descripcion_trabajo = '';
                           vm.duracion_tarea = 0;
                           vm.can_personal = 0;
                           vm.cod_material = '';
                           vm.cantidad = 0;
                           vm.idAddMantenimiento = '0';
                           vm.observacion = '';
                           vm.negativoDuracionTrabajo = false;
                           vm.negativoCantidadPersonal = false;
                           vm.negativoCantidad = false;

                       },
                       error: function (data) {
                           $("#myModal").modal('toggle');
                           var errors = '';
                           for (datos in data.responseJSON) {
                               errors += '* ' + data.responseJSON[datos] + '<br>';
                           }
                           toastr.error(errors, {timeOut: 5000});
                           //console.log(data);
                       }
                   });
               }
               else {
                   //console.log("no se agrego nada");
                   $.ajax({
                       url: 'ordenTrabajo',
                       headers: {'X-CSRF-Token': token},
                       type: 'POST',
                       dataType: 'json',
                       data: {
                           maquinaria_id: vm.maquinaria_id,
                           kilometraje: vm.kilometraje,
                           horometro: vm.horometro,
                           loca_averia: vm.loca_averia,
                           tipo_mantenimiento: vm.tipo_mantenimiento,
                           descripcion_trabajo: vm.descripcion_trabajo,
                           duracion_tarea:  vm.duracion_tarea,
                           cantidad_personal: vm.can_personal,
                           codigo_material: vm.cod_material,
                           cantidad:vm.cantidad,
                           observacion: vm.observacion
                       },
                       success: function (data) {
                           datatable();
                           $("#myModal").modal('toggle');
                           toastr.success('Maquinaria: ' + data.mensaje + ' a sido registrada', {timeOut: 5000});
                           $( "#Addtemplate" ).empty();
                           vm.maquinaria_id = '';
                           vm.kilometraje = 0;
                           vm.horometro = 0;
                           vm.loca_averia = '';
                           vm.tipo_mantenimiento = '';
                           vm.descripcion_trabajo = '';
                           vm.duracion_tarea = 0;
                           vm.can_personal = 0;
                           vm.cod_material = '';
                           vm.cantidad = 0;
                           vm.idAddMantenimiento = '0';
                           vm.observacion = '';
                           vm.negativoDuracionTrabajo = false;
                           vm.negativoCantidadPersonal = false;
                           vm.negativoCantidad = false;

                       },
                       error: function (data) {
                           $("#myModal").modal('toggle');
                           var errors = '';
                           for (datos in data.responseJSON) {
                               errors += '* ' + data.responseJSON[datos] + '<br>';
                           }
                           toastr.error(errors, {timeOut: 5000});
                           //console.log(data);
                       }
                   });
                   //$("#myModal").modal('toggle');
                   //toastr.error('Registrado Correctamente', {timeOut: 5000});
               }
           }
           else{
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
                var maquinaria_id= $("#maquinaria_id2").val();
                var kilometraje= $("#kilometraje2").val();
                var horometro= $("#horometro2").val();
                var loca_averia= $("#loca_averia2").val();
                var tipo_mantenimiento= $("#tipo_mantenimiento2").val();
                var observacion=$("#observaciones2").val();
                var concaDescMante;
                var concaDuracionTarea;
                var concaCanPersonal;
                var concaCodMaterial;
                var concaCantidad;
                var tamaño=vm.cantidadUpdate;
                for (var i = 0; i < tamaño; i++) {
                    if(i==0){
                        if ($("#descripcion_trabajoUpdate" + i).val() != undefined) {
                            concaDescMante =$("#descripcion_trabajoUpdate" + i).val();
                        }
                        if ($("#duracion_tareaUpdate" + i).val() != undefined) {
                            concaDuracionTarea =$("#duracion_tareaUpdate" + i).val();
                        }
                        if ($("#can_personalUpdate" + i).val() != undefined) {
                            concaCanPersonal =$("#can_personalUpdate" + i).val();
                        }
                        if ($("#cod_materialUpdate" + i).val() != undefined) {
                            concaCodMaterial =$("#cod_materialUpdate" + i).val();
                        }
                        if ($("#cantidadUpdate" + i).val() != undefined) {
                            concaCantidad =$("#cantidadUpdate" + i).val();
                        }
                    }else{
                        if ($("#descripcion_trabajoUpdate" + i).val() != undefined) {
                            concaDescMante = concaDescMante+" -"+ $("#descripcion_trabajoUpdate" + i).val();
                        }
                        if ($("#duracion_tareaUpdate" + i).val() != undefined) {
                            concaDuracionTarea = concaDuracionTarea+" -"+ $("#duracion_tareaUpdate" + i).val();
                        }
                        if ($("#can_personalUpdate" + i).val() != undefined) {
                            concaCanPersonal = concaCanPersonal+" -"+ $("#can_personalUpdate" + i).val();
                        }
                        if ($("#cod_materialUpdate" + i).val() != undefined) {
                            concaCodMaterial = concaCodMaterial+" -" + $("#cod_materialUpdate" + i).val();
                        }
                        if ($("#cantidadUpdate" + i).val() != undefined) {
                            concaCantidad = concaCantidad+" -" + $("#cantidadUpdate" + i).val();
                        }
                    }
                }
                var token2 = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "ordenTrabajo/"+id+"",
                    headers: { 'X-CSRF-Token' : token2 },
                    type: 'PUT',
                    dataType: 'json',
                    data:{maquinaria_id: maquinaria_id,
                        kilometraje: kilometraje,
                        horometro: horometro,
                        loca_averia: loca_averia,
                        tipo_mantenimiento: tipo_mantenimiento,
                        descripcion_trabajo: concaDescMante,
                        duracion_tarea: concaDuracionTarea,
                        cantidad_personal: concaCanPersonal,
                        codigo_material: concaCodMaterial,
                        cantidad: concaCantidad,
                        observacion: observacion
                    },
                    success: function(data1){
                        datatable();
                        $("#myModal2").modal('toggle');
                        toastr.success('La orden de trabajo ha sido actualizada '+data1.mensaje, {timeOut: 5000});

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
        $.get("ordenTrabajo/"+btn.value+"/edit", function(res){
            //var from =(res.fechacompra).split("-");
            //***separar lista**
            $("#id_actualizar").val(btn.value);
            $("#maquinaria_id2").val(res.idMAQ);
            vm.maquinariaUpdate_id=res.idMAQ;
            $("#fecha2").val(res.fecha);
            $("#kilometraje2").val(res.kilometraje);
            vm.kilometrajeUpdate=res.kilometraje;
            $("#horometro2").val(res.horometro);
            vm.horometroUpdate=res.horometro;
            $("#loca_averia2").val(res.localizacion_averia);
            vm.loca_averiaUpdate=res.localizacion_averia;
            $("#tipo_mantenimiento2").val(res.tipo_mtto);
            vm.tipo_mantenimientoUpdate=res.tipo_mtto;
            vm.observacionesUpdate=res.observacion;
            var re = /\s*-\s*/;
            var jsonDescripcionTrabajo=res.descripcion_trabajo;
            var jsonDuracionTarea=res.duracion_tarea;
            var jsonCantPersonal=res.cant_personal;
            var jsonCodMaterial=res.cod_material;
            var jsonCantidad=res.cantidad;
            var ArrayDescripcionTrabajo=jsonDescripcionTrabajo.split(re);
            var ArrayDuracionTarea=jsonDuracionTarea.split(re);
            var ArrayCantPersonal=jsonCantPersonal.split(re);
            var ArrayCodMaterial=jsonCodMaterial.split(re);
            var ArrayCantidad=jsonCantidad.split(re);
            var tamaño=ArrayDescripcionTrabajo.length;
            $("#tamaño").val(tamaño);
            vm.cantidadUpdate=tamaño;
            for (var i=0;i<tamaño;i++){
                /*
                $("#DinamicHidden").append(
                    "<input type='hidden' id='descripcion_trabajoUpdate"+i+"' name='descripcion_trabajo' value='"+ArrayDescripcionTrabajo[i]+"'>"+
                    "<input type='hidden' id='duracion_tareaUpdate"+i+"' value='"+ArrayDuracionTarea[i]+"'  >"+
                    "<input type='hidden' id='can_personalUpdate"+i+"' value='"+ArrayCantPersonal[i]+"' >"+
                    "<input type='hidden'   id='cod_materialUpdate"+i+"' value='"+ArrayCodMaterial[i]+"' >"+
                    "<input type='hidden' id='cantidadUpdate"+i+"' value='"+ArrayCantidad[i]+"' >"
                    );*/
                if(i==0){
                    $("#Addtemplate_Actualizar").append("<div class='row' id='addManteUpdate"+i+"'>" +
                        "<div class='col-sm-4'>"+
                        "<div class='form-group'>"+
                        "<label for='cod_material' class='col-sm-4 control-label'>Descripción Mantenimiento*</label>"+
                        "<input type='text'  parsley-type='text' class='form-control'  id='descripcion_trabajoUpdate"+i+"' name='descripcion_trabajo' value='"+ArrayDescripcionTrabajo[i]+"' required >"+
                        "</div>"+
                        "</div>"+
                        "<div class='col-sm-2'>"+
                        "<div class='form-group'>"+
                        "<label for='duracion_tarea' class='col-sm-4 control-label'>Duración Tarea*</label>"+
                        "<div class='input-group m-t-10'>"+
                        "<input type='number'  class='form-control' onkeyup='CambioItemNewTemplateActualizar()' id='duracion_tareaUpdate"+i+"' value='"+ArrayDuracionTarea[i]+"'  >"+
                        "<span class='input-group-addon'>Día(s)</span>"+
                        "</div>"+
                        "</div>"+
                        "</div>"+
                        "<div class='col-sm-2'>"+
                        "<div class='form-group'>"+
                        "<label for='can_personal' class='col-sm-4 control-label'>Cantidad Personal*</label>"+
                        "<input type='number'   class='form-control' onkeyup='CambioItemNewTemplateActualizar()' id='can_personalUpdate"+i+"' value='"+ArrayCantPersonal[i]+"' >"+
                        "</div>"+
                        "</div>"+
                        "<div class='col-sm-2'>"+
                        "<div class='form-group'>"+
                        "<label for='cod_material' class='col-sm-4 control-label'>Código Material*</label>"+
                        "<input type='text'  parsley-type='text' class='form-control'  id='cod_materialUpdate"+i+"' value='"+ArrayCodMaterial[i]+"' >"+
                        "</div>"+
                        "</div>"+
                        "<div class='col-sm-1'>"+
                        "<div class='form-group'>"+
                        "<label for='cantidad' class='col-sm-4 control-label'>Cantidad Material*</label>"+
                        "<input type='number'  class='form-control' onkeyup='CambioItemNewTemplateActualizar()' id='cantidadUpdate"+i+"' value='"+ArrayCantidad[i]+"' >"+
                        "</div>"+
                        "</div>"+
                        "<div class='col-sm-1'>"+
                        "<div class='form-group'>"+
                        "<label for='cantidad' class='col-sm-4 control-label' style='color:white;'>Boton Add*</label>"+
                        "<a class='btn btn-icon waves-effect waves-light btn-success m-b-5'  id='addManteUpdate"+i+"' onclick='addMantenimientoUpdate(event)' > <i class='fa fa-plus'></i> </a>"+
                        "</div>"+
                        "</div>"+
                        "</div>");
                }else {
                    $("#Addtemplate_Actualizar").append("<div class='row' id='addManteUpdate" + i + "'>" +
                        "<div class='col-sm-4'>" +
                        "<div class='form-group'>" +
                        "<label for='cod_material' class='col-sm-4 control-label'>Descripción Mantenimiento*</label>" +
                        "<input type='text'  parsley-type='text' class='form-control' onkeyup='CambioItemNewTemplateActualizar2()' id='descripcion_trabajoUpdate" + i + "' name='descripcion_trabajo' value='" + ArrayDescripcionTrabajo[i] + "' required >" +
                        "</div>" +
                        "</div>" +
                        "<div class='col-sm-2'>" +
                        "<div class='form-group'>" +
                        "<label for='duracion_tarea' class='col-sm-4 control-label'>Duración Tarea*</label>" +
                        "<div class='input-group m-t-10'>" +
                        "<input type='number'  class='form-control' onkeyup='CambioItemNewTemplateActualizar()' id='duracion_tareaUpdate" + i + "' value='" + ArrayDuracionTarea[i] + "'  >" +
                        "<span class='input-group-addon'>Día(s)</span>" +
                        "</div>" +
                        "</div>" +
                        "</div>" +
                        "<div class='col-sm-2'>" +
                        "<div class='form-group'>" +
                        "<label for='can_personal' class='col-sm-4 control-label'>Cantidad Personal*</label>" +
                        "<input type='number'   class='form-control' onkeyup='CambioItemNewTemplateActualizar()' id='can_personalUpdate" + i + "' value='" + ArrayCantPersonal[i] + "' >" +
                        "</div>" +
                        "</div>" +
                        "<div class='col-sm-2'>" +
                        "<div class='form-group'>" +
                        "<label for='cod_material' class='col-sm-4 control-label'>Código Material*</label>" +
                        "<input type='text'  parsley-type='text' class='form-control' onkeyup='CambioItemNewTemplateActualizar2()' id='cod_materialUpdate" + i + "' value='" + ArrayCodMaterial[i] + "' >" +
                        "</div>" +
                        "</div>" +
                        "<div class='col-sm-1'>" +
                        "<div class='form-group'>" +
                        "<label for='cantidad' class='col-sm-4 control-label'>Cantidad Material*</label>" +
                        "<input type='number'  class='form-control' onkeyup='CambioItemNewTemplateActualizar()' id='cantidadUpdate" + i + "' value='" + ArrayCantidad[i] + "' >" +
                        "</div>" +
                        "</div>" +
                        "<div class='col-sm-1'>" +
                        "<div class='form-group'>" +
                        "<label for='cantidad' class='col-sm-4 control-label' style='color:white;'>Boton Add*</label>" +
                        "<a class='btn btn-icon waves-effect waves-light btn-danger m-b-5'  id='addManteUpdate" + i + "' onclick='RVmantenimientoUpdate(this)' > <i class='fa fa-remove'></i> </a>" +
                        "</div>" +
                        "</div>" +
                        "</div>");
                }
            }
        });
    }
    function Ver(btn){
            var url="OrdenTrabajoPDF/"+btn.value;
            window.open(url, '_blank');
    }
    function Eliminar(btn){

        $.get("ordenTrabajo/"+btn.value+"/edit", function(res){
            $("#id_ordenTrabajo").val(btn.value);
            var conca="OT000"+res.id;
            $("#nombre_ordentrabajo").html(conca);
        });
    }
    function delete_maquinaria() {
        $("#form_eliminar").on('submit', function(e){
            var value = $("#id_ordenTrabajo").val();
            var token = $('meta[name="csrf-token"]').attr('content');
            e.preventDefault();
            $.ajax({
                url:"ordenTrabajo/"+value+"",
                headers: { 'X-CSRF-Token' : token },
                type: 'DELETE',
                dataType: 'json',
                success: function(data3){
                    datatable();
                    $("#myModal9").modal('toggle');
                    toastr.warning('La Orden de Trabajo ha sido eliminada de la BD '+data3.mensaje, {timeOut: 5000});
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
    function RVmantenimiento(idMante) {
        var conca="#"+idMante.id;
        $(conca).remove();
        //vm.idAddMantenimiento--;
    }
    function RVmantenimientoUpdate(idMante) {
        var conca="#"+idMante.id;
        $(conca).remove();
        //vm.idAddMantenimiento--;
    }
    function CambioItemNewTemplate() {
        var contador=vm.idAddMantenimiento;
        var contadorNegativo=0;
        for (var i=1;i<=contador;i++){
                    var duraciontarea=$("#duracion_tarea"+i).val();
                    var cantidadpersonal=$("#can_personal"+i).val();
                    var cantidadM=$("#cantidad"+i).val();
                    if(duraciontarea<0 || cantidadpersonal<0 || cantidadM<0){
                        contadorNegativo++;
                    }
        }
       if(contadorNegativo>0){
           vm.negativoDuracionTrabajo=true;
           vm.negativoCantidadPersonal=true;
           vm.negativoCantidad=true;
       }else{
           vm.negativoDuracionTrabajo=false;
           vm.negativoCantidadPersonal=false;
           vm.negativoCantidad=false;
       }
    }
    function CambioItemNewTemplateActualizar() {

        var contador=vm.cantidadUpdate;
        var contadorNegativo=0;
        for (var i=0;i<contador;i++){
            var duraciontarea=$("#duracion_tareaUpdate"+i).val();
            var cantidadpersonal=$("#can_personalUpdate"+i).val();
            var cantidadM=$("#cantidadUpdate"+i).val();
            console.log(duraciontarea);
            if(duraciontarea<0 || cantidadpersonal<0 || cantidadM<0){
                contadorNegativo++;
            }
        }
        if(contadorNegativo >0){
            vm.negativoDuracionTrabajo=true;
        }else{
            vm.negativoDuracionTrabajo=false;
        }
    }
    function addMantenimientoUpdate(e){
        e.preventDefault();
        var cantidadUpdate=vm.cantidadUpdate;
        $("#Addtemplate_Actualizar").append("<div class='row' id='addManteUpdate"+cantidadUpdate+"'>" +
            "<div class='col-sm-4'>"+
            "<div class='form-group'>"+
            "<label for='cod_material' class='col-sm-4 control-label'>Descripción Mantenimiento*</label>"+
            "<input type='text'  parsley-type='text' class='form-control'  id='descripcion_trabajoUpdate"+cantidadUpdate+"' name='descripcion_trabajo' required >"+
            "</div>"+
            "</div>"+
            "<div class='col-sm-2'>"+
            "<div class='form-group'>"+
            "<label for='duracion_tarea' class='col-sm-4 control-label'>Duración Tarea*</label>"+
            "<div class='input-group m-t-10'>"+
            "<input type='number'  class='form-control' onkeyup='CambioItemNewTemplate()' value='0' id='duracion_tareaUpdate"+cantidadUpdate+"' >"+
            "<span class='input-group-addon'>Día(s)</span>"+
            "</div>"+
            "</div>"+
            "</div>"+
            "<div class='col-sm-2'>"+
            "<div class='form-group'>"+
            "<label for='can_personal' class='col-sm-4 control-label'>Cantidad Personal*</label>"+
            "<input type='number'   class='form-control' onkeyup='CambioItemNewTemplate()' value='0' id='can_personalUpdate"+cantidadUpdate+"'>"+
            "</div>"+
            "</div>"+
            "<div class='col-sm-2'>"+
            "<div class='form-group'>"+
            "<label for='cod_material' class='col-sm-4 control-label'>Código Material*</label>"+
            "<input type='text'  parsley-type='text' class='form-control' value='' id='cod_materialUpdate"+cantidadUpdate+"' >"+
            "</div>"+
            "</div>"+
            "<div class='col-sm-1'>"+
            "<div class='form-group'>"+
            "<label for='cantidad' class='col-sm-4 control-label'>Cantidad Material*</label>"+
            "<input type='number'  class='form-control' onkeyup='CambioItemNewTemplate()' value='0' id='cantidadUpdate"+cantidadUpdate+"'>"+
            "</div>"+
            "</div>"+
            "<div class='col-sm-1'>"+
            "<div class='form-group'>"+
            "<label for='cantidad' class='col-sm-4 control-label' style='color:white;'>Boton Add*</label>"+
            "<a class='btn btn-icon waves-effect waves-light btn-danger m-b-5' id='addManteUpdate"+cantidadUpdate+"' onclick='RVmantenimientoUpdate(this)' > <i class='fa fa-remove'></i> </a>"+
            "</div>"+
            "</div>"+
            "</div>");
        vm.cantidadUpdate++;
    }
    
   var vm= new Vue({
        el:'#my_app',
        data:{
            maquinaria_id:'',
            kilometraje:0,
            horometro:0,
            loca_averia:'',
            tipo_mantenimiento: '',
            descripcion_trabajo:'',
            duracion_tarea:0,
            can_personal:0,
            cod_material:'',
            cantidad:0,
            observacion:'',
            idAddMantenimiento:'0',
            negativoDuracionTrabajo:false,
            negativoCantidadPersonal:false,
            negativoCantidad:false,
            AddTemplate:false,
            /*Update
            */
            maquinariaUpdate_id:'',
            kilometrajeUpdate:0,
            horometroUpdate:0,
            loca_averiaUpdate:'',
            tipo_mantenimientoUpdate:'',
            negativosUpdate:false,
            cantidadUpdate:0,
            observacionesUpdate:'',
        },
        computed:{
                activandoBTNCrear:function () {
                    return this.maquinaria_id  && this.loca_averia && this.tipo_mantenimiento && this.descripcion_trabajo && this.kilometraje>=0 && this.horometro>=0 && this.duracion_tarea>=0 && this.can_personal>=0 && this.cantidad>=0 && !this.negativoDuracionTrabajo;
                },
                activandoBTNUpdate:function () {
                    return  !this.negativoDuracionTrabajo && this.kilometrajeUpdate>=0 && this.horometroUpdate>=0;
                },
        },
        watch: {
        },
        methods: {
            addMantenimiento:function () {
                this.idAddMantenimiento++;
                this.AddTemplate=true;
                $("#Addtemplate").append("<div class='row' id='addMante"+this.idAddMantenimiento+"'>" +
                                                "<div class='col-sm-4'>"+
                                                    "<div class='form-group'>"+
                                                        "<label for='cod_material' class='col-sm-4 control-label'>Descripción Mantenimiento*</label>"+
                                                        "<input type='text'  parsley-type='text' class='form-control'  id='descripcion_trabajo"+this.idAddMantenimiento+"' name='descripcion_trabajo' required >"+
                                                    "</div>"+
                                                "</div>"+
                                                "<div class='col-sm-2'>"+
                                                    "<div class='form-group'>"+
                                                        "<label for='duracion_tarea' class='col-sm-4 control-label'>Duración Tarea*</label>"+
                                                        "<div class='input-group m-t-10'>"+
                                                            "<input type='number'  class='form-control' onkeyup='CambioItemNewTemplate()' value='0' id='duracion_tarea"+this.idAddMantenimiento+"' >"+
                                                            "<span class='input-group-addon'>Día(s)</span>"+
                                                        "</div>"+
                                                    "</div>"+
                                                "</div>"+
                                                "<div class='col-sm-2'>"+
                                                    "<div class='form-group'>"+
                                                        "<label for='can_personal' class='col-sm-4 control-label'>Cantidad Personal*</label>"+
                                                        "<input type='number'   class='form-control' onkeyup='CambioItemNewTemplate()' value='0' id='can_personal"+this.idAddMantenimiento+"'>"+
                                                    "</div>"+
                                                "</div>"+
                                                "<div class='col-sm-2'>"+
                                                    "<div class='form-group'>"+
                                                        "<label for='cod_material' class='col-sm-4 control-label'>Código Material*</label>"+
                                                        "<input type='text'  parsley-type='text' class='form-control' value='' id='cod_material"+this.idAddMantenimiento+"' >"+
                                                    "</div>"+
                                                "</div>"+
                                                "<div class='col-sm-1'>"+
                                                    "<div class='form-group'>"+
                                                        "<label for='cantidad' class='col-sm-4 control-label'>Cantidad Material*</label>"+
                                                        "<input type='number'  class='form-control' onkeyup='CambioItemNewTemplate()' value='0' id='cantidad"+this.idAddMantenimiento+"'>"+
                                                    "</div>"+
                                                "</div>"+
                                                "<div class='col-sm-1'>"+
                                                    "<div class='form-group'>"+
                                                        "<label for='cantidad' class='col-sm-4 control-label' style='color:white;'>Boton Add*</label>"+
                                                        "<a class='btn btn-icon waves-effect waves-light btn-danger m-b-5' id='addMante"+this.idAddMantenimiento+"' onclick='RVmantenimiento(this)' > <i class='fa fa-remove'></i> </a>"+
                                                    "</div>"+
                                                "</div>"+
                                        "</div>");
            },
            formRegistrar:function () {
                var csrfToken = $("#token").val();
                var form =$("#form_registrar");
                var bool=form.parsley().validate();
                if(bool){
                    if (this.idAddMantenimiento>0){
                        var concaDescMante=this.descripcion_trabajo;
                        var concaDuracionTarea=this.duracion_tarea;
                        var concaCanPersonal=this.can_personal;
                        var concaCodMaterial=this.cod_material;
                        var concaCantidad=this.cantidad;
                        for (var i=1;i<=this.idAddMantenimiento;i++){
                            if($("#descripcion_trabajo"+i).val()!=undefined ){
                                concaDescMante= concaDescMante+' -'+$("#descripcion_trabajo"+i).val();
                            }
                            if($("#duracion_tarea"+i).val()!=undefined ){
                                concaDuracionTarea=concaDuracionTarea+' -'+$("#duracion_tarea"+i).val();
                            }
                            if($("#can_personal"+i).val()!=undefined ){
                                concaCanPersonal=concaCanPersonal+' -'+$("#can_personal"+i).val();
                            }
                            if($("#cod_material"+i).val()!=undefined ){
                                concaCodMaterial=concaCodMaterial+' -'+$("#cod_material"+i).val();
                            }
                            if($("#cantidad"+i).val()!=undefined ) {
                                concaCantidad = concaCantidad + ' -' + $("#cantidad" + i).val();
                            }
                        }
                        /*
                        this.$http.post('ordenTrabajo',
                            {maquinaria_id: this.maquinaria_id,
                             kilometraje:this.kilometraje,
                             horometro:this.horometro,
                             loca_averia:this.loca_averia,
                             tipo_mantenimiento:this.tipo_mantenimiento,
                             descripcion_trabajo:concaDescMante,
                             duracion_tarea:concaDuracionTarea,
                             cantidad_personal:concaCanPersonal,
                             codigo_material:concaCodMaterial,
                             cantidad:concaCantidad
                            },
                            {headers: {'X-CSRF-TOKEN': csrfToken}
                        })
                            .then(function(data) {
                                //console.log(data.body.mensaje);
                            })
                            .catch(function (data, status, request) {
                            });*/
                        $.ajax({
                            url: 'ordenTrabajo',
                            headers: { 'X-CSRF-Token' : csrfToken },
                            type: 'POST',
                            dataType: 'json',
                            data:{
                                maquinaria_id: this.maquinaria_id,
                                kilometraje:this.kilometraje,
                                horometro:this.horometro,
                                loca_averia:this.loca_averia,
                                tipo_mantenimiento:this.tipo_mantenimiento,
                                descripcion_trabajo:concaDescMante,
                                duracion_tarea:concaDuracionTarea,
                                cantidad_personal:concaCanPersonal,
                                codigo_material:concaCodMaterial,
                                cantidad:concaCantidad,
                                observacion:this.observacion
                            },
                            success: function(data){
                                datatable();
                                $("#myModal").modal('toggle');
                                toastr.success('Maquinaria: '+data.mensaje+' a sido registrada', {timeOut: 5000});
                                    this.maquinaria_id='';
                                    this.kilometraje=0;
                                    this.horometro=0;
                                    this.loca_averia='';
                                    this.tipo_mantenimiento= '';
                                    this.descripcion_trabajo='';
                                    this.duracion_tarea=0;
                                    this.can_personal=0;
                                    this.cod_material='';
                                    this.cantidad=0;
                                    this.idAddMantenimiento='0';
                                    this.observacion='';
                                    this.negativoDuracionTrabajo=false;
                                    this.negativoCantidadPersonal=false;
                                    this.negativoCantidad=false;

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

                        //***separar lista**
                        //var re = /\s*-\s*/Tarea.split(re);;
                        //var listaSeparada = concaDuracion
                        //console.log(listaSeparada);
                    }else{
                        //console.log("no se agrego nada");
                        $.ajax({
                            url: 'ordenTrabajo',
                            headers: { 'X-CSRF-Token' : csrfToken },
                            type: 'POST',
                            dataType: 'json',
                            data:{maquinaria_id: this.maquinaria_id,
                                kilometraje:this.kilometraje,
                                horometro:this.horometro,
                                loca_averia:this.loca_averia,
                                tipo_mantenimiento:this.tipo_mantenimiento,
                                descripcion_trabajo:concaDescMante,
                                duracion_tarea:concaDuracionTarea,
                                cantidad_personal:concaCanPersonal,
                                codigo_material:concaCodMaterial,
                                cantidad:concaCantidad,
                                observacion:this.observacion,
                            },
                            success: function(data){
                                datatable();
                                $("#myModal").modal('toggle');
                                toastr.success('Maquinaria: '+data.mensaje+' a sido registrada', {timeOut: 5000});
                                this.maquinaria_id='';
                                this.kilometraje=0;
                                this.horometro=0;
                                this.loca_averia='';
                                this.tipo_mantenimiento= '';
                                this.descripcion_trabajo='';
                                this.duracion_tarea=0;
                                this.can_personal=0;
                                this.cod_material='';
                                this.cantidad=0;
                                this.observacion='';
                                this.idAddMantenimiento='0';
                                this.negativoDuracionTrabajo=false;
                                this.negativoCantidadPersonal=false;
                                this.negativoCantidad=false;

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
                    }
                    /*
                    this.$http.post('ordenTrabajo', {foo: 'bar'}, {
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                        .then(function(data) {
                                console.log(data.body.mensaje);
                        })
                        .catch(function (data, status, request) {

                        });
                     */
                }else {
                    $("#myModal").modal('toggle');
                    toastr.success('Datos no validos', {timeOut: 5000});
                }
            },
            cancelarCrearOrdenTrabajo:function () {
                $( "#Addtemplate" ).empty();
                this.maquinaria_id='';
                this.kilometraje=0;
                this.horometro=0;
                this.loca_averia='';
                this.tipo_mantenimiento= '';
                this.descripcion_trabajo='';
                this.duracion_tarea=0;
                this.can_personal=0;
                this.cod_material='';
                this.cantidad=0;
                this.observacion='';
                this.idAddMantenimiento='0';
                this.negativoDuracionTrabajo=false;
                this.negativoCantidadPersonal=false;
                this.negativoCantidad=false;
            },
            cancelarActualizarOrdenTrabajo:function () {
                $( "#Addtemplate_Actualizar" ).empty();
            }
        }

    });


</script>

@endpush