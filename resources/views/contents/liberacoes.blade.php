@extends('template.master')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4>{{$paciente->nome}}</h4>
                    <h5 style="color:#000">Valor Total: R$ {{number_format($valorTotal, 2, ',', '.')}}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-end">
            <button class="btn btn-success"  data-toggle="modal" data-target="#myModal1">Nova Liberação</button>
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
                        <th style="width: 100px;">valor</th>
                        <th>Discriminação</th>
                        </thead>
                        <tbody>
                        @foreach($liberacoes as $liberacao)
                            <tr data-id="{{$liberacao->id}}" class="liberacao">
                                <td>{{$liberacao->emissao->format('d/m/Y')}}</td>
                                <td>R$ {{number_format($liberacao->valor, 2, ',', '.')}}</td>
                                <td>{{$liberacao->discriminacao}}</td>
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
                        <form method="post" action="{{route('liberacoes.store',$paciente->id)}}" autocomplete="off">
                            @csrf
                            <div class="card-body ">
                                    <div class="form-group">
                                        <label>Valor</label>
                                        <input type="tel" placeholder="Digite o valor" name="valor" class="form-control valor">
                                    </div>
                                    <div class="form-group">
                                        <label>Discriminação</label>
                                        <textarea name="discriminacao" id="" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="id" value="">
                                    </div>
                            </div>
                            <div class="card-footer ">
                                <button type="submit" class="btn btn-fill btn-info">Registrar</button>
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
        $('.liberacoes').on('click', function() {
            var id = $(this).data('id');
            var url = '{{ route("liberacoes.index", ":slug") }}';
            url = url.replace(':slug', id);
            window.location.href=url;
        })

        $('.valor').mask('#.##0,00', {reverse: true});

    </script>
    @stop
