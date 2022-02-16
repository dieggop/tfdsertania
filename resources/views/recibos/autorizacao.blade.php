<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recibo</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="{{ asset('dist/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('dist/css/light-bootstrap-dashboard.css?v=2.0.0 ')}}" rel="stylesheet" />

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
<body onload="window.print();">
<div class="container ">
    <div class="row  d-flex justify-content-center">
        <img src="{{asset('download/sec-saude.PNG')}}" style="width: 500px" alt="" class="">
    </div>
    <div class="row text-justify mt-4">
        Autorizo efetuar o pagamento na ordem de R$ {{number_format($liberacao->valor,2)}} ({{$extenso}}), referente a TFD
        N° {{$liberacao->codigo}}, ao Sr. {{$paciente->nome}}, BRASILEIRO, {{$paciente->estado_civil}}, residente
        na {{$paciente->endereco}} ,portador do RG {{$paciente->rg}}, CPF Nº {{$paciente->cpf}}
        . {{$liberacao->discriminacao}}
    </div>
    <br><br>

    Sertânia, {!! $dataEmissao !!}
    <br>
    <br>
    <br>
    <br>
    <br><br>
    <br>
    <br>
    <p class="text-center">
        <strong>Mariana Grace Araújo Ferreira Patriota</strong><br>
    Secretário(a) de Saúde
    </p>
</div>
</body>
</html>
