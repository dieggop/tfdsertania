@extends('template.master')
@section('css')
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="card">
           <div class="card-body  ">
               <form class="navbar-form navbar-left navbar-search-form" method="post" action="{{route('pacientes.index.busca')}}" role="search">
                   @csrf
                   <div class="input-group">
                       <i class="nc-icon nc-zoom-split"></i>
                        <input type="text" value="" name="busca" class="form-control" placeholder="buscar...">
                   </div>
                   <div class="row filtrosbusca">

    <div class="col-sm-3">
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" id="filtronome" name="filtro" value="nome" checked >
                <span class="form-check-sign"></span>
                Buscar por Nome
            </label>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" id="filtrocpf" name="filtro" value="cpf">
                <span class="form-check-sign"></span>
                Buscar por CPF
            </label>
        </div>
    </div><div class="col-sm-3">
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" id="filtrocodigo" name="filtro" value="codigo">
                <span class="form-check-sign"></span>
                Buscar por Código TFD
            </label>
        </div>
    </div>
                   </div>

               </form>
           </div>

       </div>
    </div>
</div>
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header ">
                    <h4 class="card-title">Pacientes</h4>
                    <p class="card-category">Listagem de Pacientes</p>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <table class="table table-hover table-striped dados-table">
                        <thead>
                        <th>CODTFD</th>
                        <th>Data Cadastro</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Endereço</th>
                        <th>Contatos</th>
{{--                        <th>Ação</th>--}}
                        </thead>
                        <tbody>
                        @foreach($pacientes as $paciente)
                            <tr onclick="">
                                <td>{{$paciente->codigo }}</td>
                                <td>{{$paciente->data_cadastro->format('d/m/Y')}}</td>
                                <td>{{$paciente->nome}}</td>
                                <td>
                                    {{$paciente->cpf}}
                                </td>
                                <td>{{$paciente->endereco}} / {{$paciente->cidade}}</td>
                                <td>
                                    <ul class="list-group list-group-flush">
                                        @foreach($paciente->contatos as $contato)
                                            <li class="list-group-item">{{$contato->numero}}</li>
                                        @endforeach
                                    </ul>
                                </td>
{{--                                <td>--}}
{{--                                    <button class="btn btn-default">--}}
{{--                                        <i class="nc-icon nc-bullet-list-67"></i> <p>Liberações</p>--}}
{{--                                    </button>--}}
{{--                                </td>--}}
                            </tr >
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            {{ $pacientes->appends($dataForm)->onEachSide(1)->links() }}
        </div>
    </div>

@stop
