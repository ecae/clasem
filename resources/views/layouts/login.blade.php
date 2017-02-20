<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sitema de Mantenimiento Santa Margarita">
    <meta name="author" content="Clasem EON">
    <title>Clasem EOM</title>
    <link rel="stylesheet" href="{{ asset('tema1/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('tema1/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('tema1/css/icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('tema1/css/pages.css') }}" />
    <link rel="stylesheet" href="{{ asset('tema1/css/menu.css') }}" />
    <link rel="stylesheet" href="{{ asset('tema1/css/responsive.css') }}" />
    <link rel="stylesheet" href="{{ asset('tema1/css/components.css') }}" />


    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ asset('tema1/css/modernizr.min.js') }}"></script>
    <![endif]-->


</head>
<body>
<div class="wrapper-page">

    <div class="text-center">
        <label  class="logo logo-lg"><i class="md md-equalizer"></i> <span>CLASEM</span> </label>
    </div>

    <form class="form-horizontal m-t-20" role="form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" name="username" type="text" required="" autofocus placeholder="Usuario">
                <i class="md md-account-circle form-control-feedback l-h-34"></i>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control"  name="password" type="password" required="" autofocus placeholder="Contraseña">
                <i class="md md-vpn-key form-control-feedback l-h-34"></i>

            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12" >
                @include('alert.errors')
            </div>

        </div>


        <div class="form-group text-right m-t-20">
            <div class="col-xs-12">
                <button class="btn btn-pink btn-custom w-md waves-effect waves-light pull-left" type="reset">Limpiar
                </button>
                <button class="btn btn-primary btn-custom w-md waves-effect waves-light"  type="submit">Ingresar
                </button>
            </div>
        </div>


    </form>
</div>

@section('content')

@show



<script src="{{ asset('tema1/js/jquery.min.js') }}"></script>
<script src="{{ asset('tema1/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('tema1/js/detect.js') }}"></script>
<script src="{{ asset('tema1/js/fastclick.js') }}"></script>
<script src="{{ asset('tema1/js/jquery.blockUI.js') }}"></script>
<script src="{{ asset('tema1/js/waves.js') }}"></script>
<script src="{{ asset('tema1/js/wow.min.js') }}"></script>
<script src="{{ asset('tema1/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('tema1/js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('tema1/js/jquery.core.js') }}"></script>
<script src="{{ asset('tema1/js/jquery.app.js') }}"></script>

</body>
</html>