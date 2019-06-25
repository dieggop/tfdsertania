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
                            <h4 class="card-title">Modificando Dados de Paciente</h4>
                            <p>{{$paciente->nome}}</p>
                        </div>
                        <div class="card-body">
                            @if($errors->any())
                                @foreach($errors->getMessages() as $this_error)
                                    <div class="alert alert-danger">
                                        <button type="button" aria-hidden="true" class="close" data-dismiss="alert">
                                            <i class="nc-icon nc-simple-remove"></i>
                                        </button>
                                        <span>
                                            <b> Erro - </b> {{$this_error[0]}}</span>
                                    </div>

                                @endforeach
                            @endif
                            <form action="{{route('pacientes.editar.update',$paciente->id)}}" method="post" class="form-cad" autocomplete="off">
                                @csrf
                                @method('put')
                                <input type="hidden" name="id" value="{{$paciente->id}}">
                                <div class="row">
                                    <div class="col-md-5 pr-1">
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <input type="text" class="form-control" required name="nome" value="{{$paciente->nome}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 px-1">
                                        <div class="form-group">
                                            <label>Cpf</label>
                                            <input type="text" class="form-control cpf" required name="cpf" value="{{$paciente->cpf}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 pl-1">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">RG</label>
                                            <input type="tel" class="form-control" required name="rg" value="{{$paciente->rg}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" value="{{$paciente->email}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-1">
                                        <div class="form-group">
                                            <label>Cidade</label>
                                            <input type="text" class="form-control" required name="cidade" value="{{$paciente->cidade}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Endereço</label>
                                            <input type="text" class="form-control" required name="endereco" value="{{$paciente->endereco}}">
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
                                                        <input class="form-check-input" type="radio" required name="sexo" id="sexom" value="M" @if($paciente->sexo === 'M') checked @endif >
                                                        <span class="form-check-sign"></span>
                                                        Masculino
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-radio">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" required name="sexo" id="sexof" value="F" @if($paciente->sexo === 'F') checked @endif>
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
                                            <input type="text" class="form-control date" required name="nascimento" value="{{$paciente->nascimento->format('d/m/Y')}}">
                                        </div>
                                    </div> <div class="col-md-4 pr-1">
                                        <div class="form-group">
                                            <label>Estado Civil</label>
                                            <input type="text" class="form-control" required name="estado_civil" value="{{$paciente->estado_civil}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group destinoCriacaoCampo">
                                            <label>Contatos</label><br>
                                            <small>Digite o número e aperte no botão (+) para acrescentar outros números</small>
                                            @foreach($paciente->contatos as $contato)
                                            <div class="entry input-group col-xs-3">
                                                <input class="form-control telefones" name="contatos[]" required type="text" value="{{$contato->numero}}" placeholder="Digite um número" />
                                                <span class="input-group-btn">
                                                    <button class="btn btn-success btn-add" type="button">
                                                        <span class="nc-icon nc-simple-add"></span>
                                                    </button>
                                                </span>
                                             </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="excluirregistro btn btn-danger btn-fill btn-sm pull-left">Excluir Registro</button>
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

            var SPMaskBehavior = function (val) {
                    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
                },
                spOptions = {
                    onKeyPress: function(val, e, field, options) {
                        field.mask(SPMaskBehavior.apply({}, arguments), options);
                    }
                };

            $('.telefones').mask(SPMaskBehavior, spOptions);
            $('.cpf').mask('000.000.000-00', {reverse: true, clearIfNotMatch: true});
            $('.date').mask('00/00/0000', {clearIfNotMatch: true});


            $('.excluirregistro').on('click',function() {

                var secure_token = '{{ csrf_token() }}';
                var idPacienteExcluir = '{{$paciente->id}}';
                $.confirm({
                    title: 'Atenção!',
                    theme: 'material',
                    content: 'Você deseja excluir este paciente?',
                    buttons: {
                        confirm: {
                            text: 'Sim!',
                            btnClass: 'btn-red',
                            action: function () {
                                $.ajax({
                                    url: "/pacientes/{{$paciente->id}}/excluir",
                                    type: 'DELETE',
                                    data: { _token: secure_token },
                                    success: function(result) {
                                        console.log(result);
                                        $.toast({
                                            heading: 'Sucesso',
                                            text: 'O Paciente foi excluido',
                                            afterHidden: function () {
                                                window.location.href = '/pacientes/listar';
                                            }
                                        })
                                    },
                                    error: function(e) {
                                        console.log(e)
                                        $.toast({
                                            heading: 'Error',
                                            text: 'Ocorreu um erro ao tentar excluir, tente novamente',
                                            icon: 'error',
                                            afterHidden: function () {
                                                window.location.href = '/pacientes/{{$paciente->id}}/editar';
                                            }
                                        });
                                    }
                                });

                            }
                        },
                        cancel: {
                            text: 'Cancelar',
                            btnClass: 'btn-blue',
                            action: function () {
                                $.alert('Cancelado!');
                            }
                        },

                    }
                });

            })

        });



    </script>
@stop
