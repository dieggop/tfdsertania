<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recibo</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>
    <!-- CSS Files -->
    <link href="{{ asset('dist/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/light-bootstrap-dashboard.css?v=2.0.0 ')}}" rel="stylesheet"/>

    <style>
        * html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
        }

    </style>
</head>
<body>
{{--<body onload="window.print();">--}}
<div class="container ">
    <div class="row  d-flex justify-content-center">
        <img src="{{asset('download/sec-saude.PNG')}}" style="width: 500px" alt="" class="">
    </div>
    <div class="row  d-flex justify-content-center">
        <h4>CENTRAL DE REGULAÇÃO DE MÉDIA COMPLEXIDADE</h4>
    </div>
</div>

<table class="table table-bordered col-md-12">
    <tbody>
    <tr>
        <td class="text-center"><H3>FATURA DE TFD</H3></td>
        <td class="text-center" width="200"><strong>{{$liberacao->codigo}}</strong></td>
    </tr>
<tr>    <td colspan="2"><img src="{{asset('download/recibotfd.jpg')}}" alt="" class="img-fluid"></td></tr>
    </tbody>
</table>
</body>
</html>
