<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="http://www.sertania.pe.gov.br/imagens/logoprefeitura.png">
    <link rel="icon" type="image/png" href="http://www.sertania.pe.gov.br/imagens/logoprefeitura.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>TFD - Sertânia</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="{{ asset('dist/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('selectpicker/dist/css/bootstrap-select.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('dist/datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('dist/css/light-bootstrap-dashboard.css?v=2.0.0')}}" rel="stylesheet" />
    <link href="{{ asset('dist/toast/dist/jquery.toast.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('dist/jquery-confirm/dist/jquery-confirm.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('css/internas.css?v=2.0.0 ')}}" rel="stylesheet" />
</head>

<body>
<div class="wrapper">
    <div class="sidebar" data-image="{{ asset('dist/img/sidebar-5.jpg')}}" data-color="red">
        <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

    Tip 2: you can also add an image using data-image tag
-->
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="javascript:;" class="simple-text">
                   TFD Sertânia
                </a>
            </div>
            <ul class="nav">
                <li class="nav-item ">
                    <a class="nav-link" href="{{route('pacientes.cadastro')}}">
                        <i class="nc-icon nc-icon nc-paper-2"></i>
                        <p>Cadastrar Pacientes</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{route('pacientes.index')}}">
                        <i class="nc-icon nc-notes"></i>
                        <p>Lista Pacientes</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="./user.html">
                        <i class="nc-icon nc-bell-55"></i>
                        <p>Relatórios</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg " color-on-scroll="500">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"> TFD </a>

                <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <span class="no-icon">Sair</span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                <div class="section">
                    @yield('content')
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav>
                    <ul class="footer-menu">
                        <li>
                            <a href="http://www.sertania.pe.gov.br">
                                Prefeitura
                            </a>
                        </li>
                        <li>
                            <a href="http://www.sertania.pe.gov.br/orgaos">
                                Contato
                            </a>
                        </li>

                    </ul>
                    <p class="copyright text-center">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>

                    </p>
                </nav>
            </div>
        </footer>
    </div>
</div>
<!--   -->
</body>
<!--   Core JS Files   -->
<script src="{{asset('dist/js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="{{asset('dist/js/plugins/bootstrap-switch.js')}}"></script>
<script src="{{asset('selectpicker/dist/js/bootstrap-select.js')}}"></script>
<script src="{{asset('dist/datetimepicker/build/js/moment.js')}}"></script>
<script src="{{asset('dist/datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('dist/js/plugins/bootstrap-notify.js')}}"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="{{asset('dist/js/light-bootstrap-dashboard.js?v=2.0.0 ')}}" type="text/javascript"></script>
<script src="{{asset('dist/js/scripts.js')}}" type="text/javascript"></script>
<script src="{{asset('jquerymask/dist/jquery.mask.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/toast/dist/jquery.toast.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/jquery-confirm/dist/jquery-confirm.min.js')}}" type="text/javascript"></script>
@yield('js')
</html>
