@extends('template.master')
@section('css')
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Cadastro de Paciente</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('pacientes.cadastro.enviar')}}" method="post" class="form-cad" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5 pr-1">
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <input type="text" class="form-control" name="nome" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-3 px-1">
                                        <div class="form-group">
                                            <label>Cpf</label>
                                            <input type="text" class="form-control" name="cpf" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4 pl-1">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">RG</label>
                                            <input type="tel" class="form-control" name="rg">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-1">
                                        <div class="form-group">
                                            <label>Cidade</label>
                                            <input type="text" class="form-control" name="cidade">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Endereço</label>
                                            <input type="text" class="form-control" name="endereco" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 px-3">
                                        <div class="form-group">
                                            <label>Sexo</label>
                                            <div class=" checkbox-radios">
                                                <div class="form-check form-check-radio">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="sexo" id="sexom" value="m">
                                                        <span class="form-check-sign"></span>
                                                        Masculino
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-radio">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="sexo" id="sexof" value="f" checked="">
                                                        <span class="form-check-sign"></span>
                                                        Feminino
                                                    </label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 pr-1">
                                        <div class="form-group">
                                            <label>Data de Nascimento</label>
                                            <input type="date" class="form-control " name="nascimento" >
                                        </div>
                                    </div> <div class="col-md-4 pr-1">
                                        <div class="form-group">
                                            <label>Estado Civil</label>
                                            <input type="text" class="form-control" name="estado_civil" >
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group destinoCriacaoCampo">
                                            <label>Contatos</label><br>
                                            <small>Digite o número e aperte no botão (+) para acrescentar outros números</small>
                                            <div class="entry input-group col-xs-3">
                                                <input class="form-control" name="contatos[]" type="text" placeholder="Digite um número" />
                                                <span class="input-group-btn">
                                                    <button class="btn btn-success btn-add" type="button">
                                                        <span class="nc-icon nc-simple-add"></span>
                                                    </button>
                                                </span>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info btn-fill pull-right">Salvar Dados</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@stop
@section('js')
    <script>
        $(function () {
            $('.datepicker').datetimepicker();
        });

    </script>
@stop
