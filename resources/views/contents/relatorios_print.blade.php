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
        <h4>RELATÓRIO GERAL DE TFD</h4>

    </div>
    <P class="text-center">Período: {{$periodo[0]}} a {{$periodo[1]}}</P>
</div>

<table class="table table-bordered col-md-12">
    <tbody>
    <thead>
        <tr>
            <th>EMISSÃO</th>
            <th>Nº</th>
            <th>FAVORECIDO</th>
            <th>CPF</th>
            <th>RG</th>
            <th>VALOR</th>
        </tr>
    </thead>
    <tbody>
    @foreach($relatorio as $emissao)

        <tr>
            <td>{{$emissao->emissao->format('d/m/Y')}}</td>
            <td>{{$emissao->codigo}}</td>
            <td>@if($emissao->paciente){{$emissao->paciente->nome}}@endif</td>
            <td>{{$emissao->paciente->cpf}}</td>
            <td>{{$emissao->paciente->rg}}</td>
            <td>R$ {{number_format($emissao->valor,2,',','')}}</td>
        </tr>
    @endforeach
    </tbody>
    </tbody>
</table>
</body>
</html>
