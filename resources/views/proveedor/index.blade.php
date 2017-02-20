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

@include('proveedor.modalCrearProveedor')
@include('proveedor.modalVer')
@include('proveedor.modalActualizarProveedor')
@include('proveedor.modalEliminarProveedor')


<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>Lista de Proveedores</b></h4>
            <p class="text-muted font-13 m-b-30">
                Proveedores registrados en la Base de Datos.
            </p>
            <div class="row">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <div class="col-md-1 col-sm-push-0 col-xs-push-2 pull-left">
                    <button type="button"  class="btn btn-success" data-toggle='modal' data-target='#myModal' ><i class='fa fa-plus fa-fw'></i> Agregar</button>

                </div>

            </div>
            <br>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>RUC</th>
                    <th>Raz&oacute;n Social</th>
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
        delete_proveedor();
    });
   function datatable() {
       $('#datatable-responsive').DataTable( {
           "destroy":true,
           "processing": true,
           "serverSide": true,
           "ajax": "getProveedores",
           "columns":[
               {data:'id'},
               {data:'ruc'},
               {data:'razonsocial'},
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
               var dato=$("#ruc").val();
               var dato2=$("#rsocial").val();
               var dato3=$("#direccion").val();
               var dato4=$("#ncompletos").val();
               var dato5=$("#email").val();
               var dato6=$("#celular").val();
               var dato7=$("#descripcion").val();
               var dato8=$("#estado").val();
               $.ajax({
                   url: 'Proveedores',
                   headers: { 'X-CSRF-Token' : token },
                   type: 'POST',
                   dataType: 'json',
                   data: {ruc: dato,
                       razonsocial:dato2,
                       direccion:dato3,
                       nombrecontacto:dato4,
                       email:dato5,
                       celular:dato6,
                       descripcion:dato7,
                       estado:dato8
                   },
                   success: function(data){
                       datatable();
                       $("#myModal").modal('toggle');
                       toastr.success('Proveedor: '+data.mensaje+' ha sido registrado', {timeOut: 5000});
                            vm.rsocial='';
                            vm.ruc='';
                            vm.direccion='';
                            vm.ncompletos='';
                            vm.celular='';
                            vm.email='';
                            vm.descripcion='';
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
               var dato=$("#ruc2").val();
               var dato2=$("#rsocial2").val();
               var dato3=$("#direccion2").val();
               var dato4=$("#ncontacto2").val();
               var dato5=$("#celular2").val();
               var dato6=$("#email2").val();
               var dato7=$("#descripcion2").val();
               var dato8=$("#estado2").val();
               var id= $("#id_actualizar").val();
               $.ajax({
                   url: "Proveedores/"+id+"",
                   headers: { 'X-CSRF-Token' : token },
                   type: 'PUT',
                   dataType: 'json',
                   data: {ruc: dato,
                       razonsocial:dato2,
                       direccion:dato3,
                       nombrecontacto:dato4,
                       celular:dato5,
                       email:dato6,
                       descripcion:dato7,
                       estado:dato8
                   },
                   success: function(data1){
                       datatable();
                       $("#myModal2").modal('toggle');
                       toastr.success('Proveedor: '+data1.mensaje+' a sido actualizado', {timeOut: 5000});
                       vm.cambio1=false;
                       vm.cambio2=false;
                       vm.cambio3=false;
                       vm.cambio4=false;
                       vm.cambio5=false;
                       vm.cambio6=false;
                       vm.cambio7=false;
                       vm.cambio8=false;
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

        $.get("Proveedores/"+btn.value+"/edit", function(res){
            $("#ruc2").val(res.ruc);
            $("#rsocial2").val(res.razonsocial);
            $("#direccion2").val(res.direccion);
            $("#ncontacto2").val(res.nombrecontacto);
            $("#celular2").val(res.celular);
            $("#email2").val(res.email);
            $("#descripcion2").val(res.descripcion);
            $("#estado2").val(res.estado);

            $("#id_actualizar").val(btn.value);

            $("#id_o_ruc").val(res.ruc);
            $("#id_o_rsocial").val(res.razonsocial);
            $("#id_o_direccion").val(res.direccion);
            $("#id_o_ncontacto").val(res.nombrecontacto);
            $("#id_o_celular").val(res.celular);
            $("#id_o_email").val(res.email);
            $("#id_o_descripcion").val(res.descripcion);
            $("#id_o_estado").val(res.estado);

        });
    }
    function Ver(btn){

        $.getJSON("Proveedores/"+btn.value+"/edit",function (res) {

                var estado=res.estado;
                $("#ruc5").text(res.ruc);
                $("#rsocial5").text(res.razonsocial);
                $("#direccion5").text(res.direccion);
                $("#ncontacto5").text(res.nombrecontacto);
                $("#celular5").text(res.celular);
                $("#email5").text(res.email);
                $("#descripcion5").text(res.descripcion);

                if(estado==1){$("#estado5").text('Activo');}
                else {$("#estado5").text('Suspendido');};

                $("#id").val(btn.value);
        })
    }

    function Eliminar(btn){

        $.get("Proveedores/"+btn.value+"/edit", function(res){
            $("#id_proveedor").val(btn.value);
            $("#rsocial_proveedor").html(res.razonsocial);
        });
    }
    function delete_proveedor() {
        $("#form_eliminar").on('submit', function(e){
            var value = $("#id_proveedor").val();
            var token = $('meta[name="csrf-token"]').attr('content');
            e.preventDefault();
            $.ajax({
                url:"Proveedores/"+value+"",
                headers: { 'X-CSRF-Token' : token },
                type: 'DELETE',
                dataType: 'json',

                success: function(data3){

                    datatable();
                    $("#myModal9").modal('toggle');
                    toastr.warning('EL Proveedor ha sido eliminado de la BD '+data3.mensaje, {timeOut: 5000});

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
            rsocial:'',
            ruc:'',
            direccion:'',
            ncompletos:'',
            celular:'',
            email:'',
            descripcion: '',
            estado:'',
            estadoruc:false,
            cambio1:false,
            cambio2:false,
            cambio3:false,
            cambio4:false,
            cambio5:false,
            cambio6:false,
            cambio7:false,
            cambio8:false,
            errorRuc:'none',
            errorRucBorder:'#EEEEEE',

        },
        computed:{
            activando: function () {
                return this.rsocial && this.estadoruc && this.direccion && this.ncompletos && this.celular && this.email && this.descripcion && this.estado;
            },
            activando2: function () {
                return this.cambio1 || this.cambio2  || this.cambio3 || this.cambio4 || this.cambio5 || this.cambio6 || this.cambio7 || this.cambio8;
            }

        },
        watch: {

        },
        methods: {
            changeRuc:function (event) {

                var ruc=event.target.value.toLowerCase();
                var originalRuc=$("#id_o_ruc").val().toLowerCase();
                var comprobando=this.esrucok(ruc);
                if(comprobando){
                    if(ruc==originalRuc){
                        this.cambio1=false;
                        this.errorRuc='none';
                        this.errorRucBorder='#EEEEEE';
                    }else{
                        this.errorRuc='none';
                        this.errorRucBorder='#EEEEEE';
                        this.cambio1=true;
                    }
                }
                else{
                    this.errorRuc='block';
                    this.errorRucBorder='#ef5350';
                    this.cambio1=false;
                }

            },
            changeRsocial:function (event) {
                if($("#id_o_rsocial").val().toLowerCase()==event.target.value.toLowerCase()){
                    this.cambio2=false;
                }else {this.cambio2=true;}

            },
            changeDireccion:function (event) {
                if($("#id_o_direccion").val().toLowerCase()==event.target.value.toLowerCase()){
                    this.cambio3=false;
                }else {this.cambio3=true;}

            },
            changeNcontacto:function (event) {
                if($("#id_o_ncontacto").val().toLowerCase()==event.target.value.toLowerCase()){
                    this.cambio4=false;
                }else {this.cambio4=true;}

            },
            changeCelular:function (event) {
                if($("#id_o_celular").val().toLowerCase()==event.target.value.toLowerCase()){
                    this.cambio5=false;
                }else {this.cambio5=true;}

            },
            changeEmail:function (event) {
                if($("#id_o_email").val().toLowerCase()==event.target.value.toLowerCase()){
                    this.cambio6=false;
                }else {this.cambio6=true;}

            },
            changeDescripcion:function (event) {
                if($("#id_o_descripcion").val().toLowerCase()==event.target.value.toLowerCase()){
                    this.cambio7=false;
                }else {this.cambio7=true;}

            },
            changeEstado:function (event) {
                if($("#id_o_estado").val()==event.target.value){
                    this.cambio8=false;
                }else {this.cambio8=true;}

            },
            cancelarCrear:function(){
                this.rsocial='';
                this.ruc='';
                this.direccion='';
                this.ncompletos='';
                this.celular='';
                this.email='';
                this.descripcion='';
                this.estado='';
            },
            cancelarActualizar:function(){
                this.cambio1=false;
                this.cambio2=false;
                this.cambio3=false;
                this.cambio4=false;
                this.cambio5=false;
                this.cambio6=false;
                this.cambio7=false;
                this.cambio8=false;
            },
            ValidarRuc:function (event) {
                //console.log(!( this.esnulo(this.ruc) || !this.esnumero(this.ruc) || !this.eslongrucok(this.ruc) || !this.valruc(this.ruc) ));
                    var ruc=event.target.value;

                    if(this.esrucok(ruc)){
                        this.estadoruc=true;
                        this.errorRuc='none';
                        this.errorRucBorder='#EEEEEE';

                    }
                    else{
                        this.errorRuc='block';
                        this.errorRucBorder='#ef5350';
                        this.estadoruc=false;
                    }

            },
            esrucok:function (ruc) {
                return (!( this.esnulo(ruc) || !this.esnumero(ruc) || !this.eslongrucok(ruc) || !this.valruc(ruc) ));
            },
            esnumero:function (ruc) {
                return(!(isNaN(ruc)));
            },
            eslongrucok:function (ruc) {
                return(ruc.length==11);
            },
            esnulo:function (ruc) {
                return (ruc == null||ruc=="");
            },
            trim:function (ruc) {
                var cadena2 = "";
                len = ruc.length;
                for ( var i=0; i <= len ; i++ ) if ( ruc.charAt(i) != " " ){cadena2+=ruc.charAt(i);	}
                return cadena2;
            },
            valruc:function (ruc) {
                valor = this.trim(ruc)
                if ( this.esnumero( valor ) ) {
                    if ( valor.length == 8 ){
                        suma = 0
                        for (i=0; i<valor.length-1;i++){
                            digito = valor.charAt(i) - '0';
                            if ( i==0 ) suma += (digito*2)
                            else suma += (digito*(valor.length-i))
                        }
                        resto = suma % 11;
                        if ( resto == 1) resto = 11;
                        if ( resto + ( valor.charAt( valor.length-1 ) - '0' ) == 11 ){
                            return true
                        }
                    } else if ( valor.length == 11 ){
                        suma = 0
                        x = 6
                        for (i=0; i<valor.length-1;i++){
                            if ( i == 4 ) x = 8
                            digito = valor.charAt(i) - '0';
                            x--
                            if ( i==0 ) suma += (digito*x)
                            else suma += (digito*x)
                        }
                        resto = suma % 11;
                        resto = 11 - resto

                        if ( resto >= 10) resto = resto - 10;
                        if ( resto == valor.charAt( valor.length-1 ) - '0' ){
                            return true
                        }
                    }
                }
                return false;
            }


        }

    });


</script>
<!--<script src="{{ asset('js/personal_vue.js') }}"></script> -->
@endpush