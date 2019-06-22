@extends('template.master_for_home')
@section('css')
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3 col-sm-12 d-flex align-items-center align-items-sm-center align-self-center">
                <div class="logo col-md-12 text-center">
                    <img src="http://sertania.pe.gov.br/imagens/logoprefeitura.png" alt="" class="img-responsive">
                </div>
            </div>
            <div class="col-md-5">

                <div class="card">
                    <div class="card-header d-flex justify-content-center">
                        TFD
                    </div>
                    <div class="card-body">
                        <div class="login box-login animated">
                            <div class="box">
                                <div class="content ">
                                    <div class="form loginBox">

                                        <form method="post" action="{{ route('login') }}"  autocomplete="off">
                                            @csrf
                                            <input id="username" class="form-control" type="text" placeholder="Digite seu login" name="username">
                                            <input id="password" class="form-control" type="password" placeholder="E a sua senha" name="password">
                                            <button class="btn btn-default btn-login" type="submit">Login</form>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
