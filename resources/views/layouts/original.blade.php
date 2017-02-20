
<!DOCTYPE html>
<html>
<head>
    <?php echo
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header('Content-Type: text/html');?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sitema de Mantenimiento Santa Margarita">
    <meta name="author" content="CLASEM EON">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Clasem EOM</title>


    @stack('css')

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


<!-- Navigation Bar-->
<header id="topnav">
    <div class="topbar-main">
        <div class="container">

            <!-- Logo container-->
            <div class="logo">
                <a href="index.html" class="logo"><i class="md md-equalizer"></i> <span>CLASEM EOM</span> </a>
            </div>
            <!-- End Logo container-->

            <div class="menu-extras">

                <ul class="nav navbar-nav navbar-right pull-right">
                    <li class="dropdown hidden-xs">
                        <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light"
                           data-toggle="dropdown" aria-expanded="true">
                            <i class="md md-notifications"></i> <span
                                    class="badge badge-xs badge-pink">3</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg">
                            <li class="text-center notifi-title">Notificaciones</li>
                            <li class="list-group nicescroll notification-list">
                                <!-- list item-->
                                <a href="javascript:void(0);" class="list-group-item">
                                    <div class="media">
                                        <div class="pull-left p-r-10">
                                            <em class="fa fa-diamond noti-primary"></em>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="media-heading">A new order has been placed A new
                                                order has been placed</h5>
                                            <p class="m-0">
                                                <small>There are new settings available</small>
                                            </p>
                                        </div>
                                    </div>
                                </a>

                                <!-- list item-->
                                <a href="javascript:void(0);" class="list-group-item">
                                    <div class="media">
                                        <div class="pull-left p-r-10">
                                            <em class="fa fa-cog noti-warning"></em>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="media-heading">New settings</h5>
                                            <p class="m-0">
                                                <small>There are new settings available</small>
                                            </p>
                                        </div>
                                    </div>
                                </a>

                                <!-- list item-->
                                <a href="javascript:void(0);" class="list-group-item">
                                    <div class="media">
                                        <div class="pull-left p-r-10">
                                            <em class="fa fa-bell-o noti-success"></em>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="media-heading">Updates</h5>
                                            <p class="m-0">
                                                <small>There are <span class="text-primary">2</span> new
                                                    updates available
                                                </small>
                                            </p>
                                        </div>
                                    </div>
                                </a>

                            </li>

                            <li>
                                <a href="javascript:void(0);" class=" text-right">
                                    <small><b>See all notifications</b></small>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><img src="{{ asset('img/avatar.png') }}" alt="user-img" class="img-circle"> </a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="ti-user m-r-5"></i> {!! Auth::user()->username !!}</a></li>

                            <li>
                                <a href="{{ route('logout') }}"><i class="ti-power-off m-r-5"></i> Salir</a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>

                </div>
             </div>
    <!-- End topbar -->


    <!-- End mobile menu toggle-->
         </div>
    </div>

    <!-- Navbar Start -->
    <div class="navbar-custom">
        <div class="container">
            <div id="navigation">
                @if(Auth::user()->tipousuario_id == 1)
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li class="has-submenu active">
                        <a href="{!!URL::to('/')!!}"><i class="md  md-home"></i>Inicio</a>
                    </li>
                    <li class="has-submenu ">
                        <a href="{!!URL::to('/admin/areas')!!}"><i class="md md-store"></i>Areas</a>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><i class="md md-people"></i>Personal</a>
                        <ul class="submenu">
                            <li><a href="{!!URL::to('/admin/usuarios')!!}">Usuarios</a></li>
                            <li><a href="{!!URL::to('/admin/personal')!!}">Personal</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu ">
                        <a href="{!!URL::to('/admin/Proveedores')!!}"><i class="md md-quick-contacts-dialer"></i>Proveedores</a>

                    </li>
                    <li class="has-submenu ">
                        <a href="{!!URL::to('/admin/ordenTrabajo')!!}"><i class="md md-border-color"></i>O. Trabajo</a>

                    </li>

                    <li class="has-submenu">
                        <a href="#"><i class="md md-local-shipping"></i>Maquinarias</a>
                        <ul class="submenu">
                            <li><a href="{!!URL::to('/admin/equipos')!!}">Maquinarias</a></li>
                            <li><a href="{!!URL::to('/admin/asignacion')!!}">Asignar Maquinarias</a></li>
                            <li><a href="{!!URL::to('/admin/mantenimientos')!!}">Mantenimientos</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu ">
                        <a href=""><i class="md  md-my-library-books"></i>Solicitudes</a>
                    </li>
                    <li class="has-submenu ">
                        <a href="{!!URL::to('/admin/calendario')!!}"><i class="md md-event"></i>Calendario</a>

                    </li>
                </ul>
                <!-- End navigation menu -->
                @elseif(Auth::user()->tipousuario_id == 2)
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li class="has-submenu">
                        <a href="{!!URL::to('operario/Home')!!}"><i class="md  md-home"></i>Inicio</a>
                    </li>
                    <li class="has-submenu ">
                        <a href="{!!URL::to('/operario/asignado')!!}"><i class="md md-local-shipping"></i>Maquinaria Asignada</a>

                    </li>
                    <li class="has-submenu ">
                        <a href="{!!URL::to('/operario/reporteUso')!!}"><i class="md  md-access-time"></i>Reporte de uso</a>

                    </li>
                    <li class="has-submenu ">
                        <a href="{!!URL::to('operario/calendario')!!}"><i class="md md-event"></i>Calendario</a>

                    </li>
                    <li class="has-submenu">
                        <a href="#"><i class="md md-invert-colors-on"></i>Reporte diario</a>
                        <ul class="submenu">
                            <li><a href="components-grid.html">Grid</a></li>
                            <li><a href="components-widgets.html">Widgets</a></li>
                            <li><a href="components-nestable-list.html">Nesteble</a></li>
                            <li><a href="components-range-sliders.html">Range Sliders </a></li>
                            <li><a href="components-sweet-alert.html">Sweet Alerts </a></li>
                        </ul>
                    </li>
                </ul>
                @endif
            </div>
        </div>
    </div>
</header>
<!-- End Navigation Bar-->


<!-- =======================
     ===== START PAGE ======
     ======================= -->

<div class="wrapper" id="my_app">
    <div class="container">
        @section('content')
        @show

        <!-- Footer -->
        <footer class="footer text-right">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        2016 &copy; Clasem EOM.
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->

    </div> <!-- end container -->
</div>








<!-- jQuery  -->
<script src="{{ asset('tema1/js/jquery.min.js') }}"></script>
<script src="{{ asset('tema1/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('tema1/js/detect.js') }}"></script>
<script src="{{ asset('tema1/js/fastclick.js') }}"></script>
<script src="{{ asset('tema1/js/jquery.blockUI.js') }}"></script>
<script src="{{ asset('tema1/js/waves.js') }}"></script>
<script src="{{ asset('tema1/js/wow.min.js') }}"></script>
<script src="{{ asset('tema1/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('tema1/js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('tema1/js/custombox.min.js') }}"></script>
<script src="{{ asset('tema1/js/legacy.min.js') }}"></script>

<script src="{{ asset('tema1/js/jquery.core.js') }}"></script>
<script src="{{ asset('tema1/js/jquery.app.js') }}"></script>



@section('js')
@show

@stack('scripts')
</body>
</html>