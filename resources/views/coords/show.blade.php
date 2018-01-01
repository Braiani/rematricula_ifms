@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{asset('css/custom.css') }}">
@stop

@section('title', 'RematrículaIF - Avaliação registro')

@section('content_header')
    <h1>Registro estudante - {{$registros[0]->nome}}</h1>
@stop

@section('content')
@include('layouts.errors')
@include('layouts.sucesso_session')
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-md-10">
            <h3>Foram encontrados os seguintes registros para o(a) estudante selecionado:</h3>
            <div class="row">
                <div class="pull-right">
                    {{--  <a href="{{url('/cerel/comprovante/'.$aluno->id)}}" class="btn btn-primary">Imprimir comprovante</a>  --}}
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Estudante</th>
                            <th>CR</th>
                            <th>Disciplina</th>
                            <th>Semestre rematrícula</th>
                            <th>Situação</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($registros as $registro)
                            <tr class="{{$registro->avaliacao == 1 ? 'success' : ($registro->avaliacao == 2 ? 'danger' :'')}}">
                                <td>{{$registro->nome}}</td>
                                <td>{{$registro->CR}}</td>
                                <td>{{$registro->disciplina}}</td>
                                <td>{{$registro->semestre}}</td>
                                <td>{{($registro->situacao == 1) ? "Dependência" : "Retido" }}</td>
                                <td>
                                    @if ($registro->avaliacao == null)
                                        <a href="{{url('/coords/analisar/'.$registro->id.'/acepted')}}" class="btn btn-success aceitar">Aceitar</a>
                                        <a href="{{url('/coords/analisar/'.$registro->id.'/declined')}}" class="btn btn-danger rejeitar">Rejeitar</a>
                                    @else
                                        <p class="btn btn-default disabled">Disciplina avaliada e {{($registro->avaliacao == 1) ? 'aceita' : 'rejeitada'}}</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$registros->links()}}
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.aceitar').on('click', function () {

                var confirmado = confirm('Tem certeza que deseja aceitar?');
            
                if (! confirmado) return false;
            });
            $('.rejeitar').on('click', function () {

                var confirmado = confirm('Tem certeza que deseja rejeitar?');
            
                if (! confirmado) return false;
            });
            $('.table').DataTable({
                dom: "f",
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json"
                }
            });
        });
    </script>
@endsection