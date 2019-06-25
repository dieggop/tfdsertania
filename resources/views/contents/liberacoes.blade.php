@extends('template.master')
@section('css')
    <style>
        .excluir {
            display: none;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-head d-flex justify-content-end">
                    <div class="btn-group">
                        <a href="{{route('pacientes.editar', $paciente->id)}}" class="btn btn-success btn-sm" >Editar Dados</a>
                    </div>
                </div>
                <div class="card-body">
                    <h4>{{$paciente->nome}}</h4>
                    <h5 style="color:#000">Valor Total: R$ {{number_format($valorTotal, 2, ',', '.')}}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-end">
            <button class="btn btn-success novaliberacao" >Cadastrar Liberação</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header ">
                    <h4 class="card-title">Liberações</h4>
                    <p class="card-category">Listagem de Pacientes</p>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <table class="table table-hover table-striped dados-table">
                        <thead>
                        <th>Emissão</th>
                        <th>Código</th>
                        <th style="width: 100px;">valor</th>
                        <th>Discriminação</th>
                        </thead>
                        <tbody>
                        @foreach($liberacoes as $liberacao)
                            <tr>
                                <td  data-id="{{$liberacao->id}}" class="liberacaoClick">{{$liberacao->emissao->format('d/m/Y')}}</td>
                                <td  data-id="{{$liberacao->id}}" class="liberacaoClick">{{$liberacao->codigo}}</td>
                                <td  data-id="{{$liberacao->id}}" class="liberacaoClick">R$ {{number_format($liberacao->valor, 2, ',', '.')}}</td>
                                <td  data-id="{{$liberacao->id}}" class="liberacaoClick">{{$liberacao->discriminacao}}</td>
                                <td>
                                    <div class="btn-group-vertical btn-group-sm">
                                        <a href="{{route('liberacoes.autorizacao',[$paciente->id,$liberacao->id])}}" class="btn btn-secondary  btn-sm">Autorização</a>
                                        <a href="{{route('liberacoes.guiafatura',[$paciente->id,$liberacao->id])}}" class="btn btn-secondary  btn-sm">Guia de Fatura</a>
                                        <a href="{{asset('download/recibo.pdf')}}" target="_blank" class="btn btn-secondary  btn-sm">Recibo</a>
                                    </div>
                                </td>
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
            {{ $liberacoes->onEachSide(1)->links() }}
        </div>
    </div>
    <div class="modal fade  modal-primary" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">

                    <div class="card stacked-form">
                        <div class="card-header ">
                            <h4 class="card-title">Liberação</h4>
                        </div>
                        <form method="post" class="liberacaoForm" action="{{route('liberacoes.store',$paciente->id)}}" autocomplete="off">
                            @csrf
                            <div class="card-body ">
                                    <div class="form-group">
                                        <label>Valor</label>
                                        <input type="tel" placeholder="Digite o valor" name="valor" class="form-control valorInput valor">
                                    </div>
                                    <div class="form-group">
                                        <label>Discriminação</label>
                                        <textarea name="discriminacao" id="" cols="30" rows="10" class="form-control discriminacao"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="id" class="idliberacao" value="">
                                    </div>
                            </div>
                            <div class="card-footer ">
                                <button type="button" class="btn btn-fill btn-danger excluirliberacao">Excluir</button>
                                <button type="submit" class="btn btn-fill btn-info btnregistro">Registrar</button>
                            </div>
                        </form>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link btn-simple" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>

        $('.novaliberacao').on('click', function() {
            $('.excluirliberacao').hide();
            $('.liberacaoForm .btnregistro').val("Registrar")
            $('#myModal1').modal();
        });
        $('.liberacaoClick').on('click', function() {
            var idLiberacao = $(this).data('id');
            $.get( "/pacientes/{{$paciente->id}}/liberacoes/"+idLiberacao+"/detalhes", function( data ) {
                $('.liberacaoForm .valorInput').val(data.valor)
                $('.liberacaoForm .discriminacao').val(data.discriminacao)
                $('.liberacaoForm .idliberacao').val(idLiberacao)
                $('.liberacaoForm .btnregistro').val("Alterar")
                $('.excluirliberacao').show();

                $('#myModal1').modal();
            } );
        })

        $('.excluirliberacao').on('click',function() {
            var secure_token = '{{ csrf_token() }}';
            var idLiberacaoExcluir = $('.liberacaoForm .idliberacao').val();
            $.confirm({
                title: 'Atenção!',
                theme: 'material',
                content: 'Você deseja excluir esta liberação?',
                buttons: {
                    confirm: {
                        text: 'Sim!',
                        btnClass: 'btn-red',
                        action: function () {
                            $.ajax({
                                url: "/pacientes/{{$paciente->id}}/liberacoes/"+idLiberacaoExcluir+"/excluir",
                                type: 'DELETE',
                                data: { _token: secure_token },
                                success: function(result) {
                                    console.log(result);
                                    $.toast({
                                        heading: 'Sucesso',
                                        text: 'A liberação foi excluida',
                                        afterHidden: function () {
                                            window.location.href = '/pacientes/{{$paciente->id}}/liberacoes';
                                        }
                                    })
                                },
                                error: function(e) {
                                    console.log(e)
                                    $.toast({
                                        heading: 'Error',
                                        text: 'Ocorreu um erro ao tentar excluir a liberação, tente novamente',
                                        icon: 'error',
                                        afterHidden: function () {
                                            window.location.href = '/pacientes/{{$paciente->id}}/liberacoes';
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
        $('.valor').mask('#.##0,00', {reverse: true});

    </script>
    @stop
