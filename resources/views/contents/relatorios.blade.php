@extends('template.master')
@section('css')
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="card">
           <div class="card-body  ">
               <form class="" method="post" action="{{route('relatorios.gerar')}}" role="search">
                   @csrf
                   <div class="input-group">
                       <div class="input-group-addon">
                           <i class="nc-icon nc-time-alarm"></i>
                       </div>
                       <input type="text" name="periodo" class="date form-control pull-right" id="reservation"></div>

<button class="btn btn-success col-md-12" type="submit">Gerar Relatório</button>
               </form>
           </div>

       </div>
    </div>
</div>

@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>

    <script>
        $('.date').daterangepicker({
            locale: { format: 'DD/MM/YYYY' }
        })

    </script>
    @stop
