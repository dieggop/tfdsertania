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
    <link href="{{ asset('dist/css/light-bootstrap-dashboard.css?v=2.0.0 ')}}" rel="stylesheet" />
    @yield('css')
</head>

<body>
<div class="wrapper d-flex align-items-center">

@yield('content')

</div>

</body>
<!--   Core JS Files   -->
<script src="{{asset('dist/js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="{{asset('dist/js/plugins/bootstrap-switch.js')}}"></script>
<!--  Chartist Plugin  -->
<script src="{{asset('dist/js/plugins/chartist.min.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('dist/js/plugins/bootstrap-notify.js')}}"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="{{asset('dist/js/light-bootstrap-dashboard.js?v=2.0.0 ')}}" type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->

</html>
