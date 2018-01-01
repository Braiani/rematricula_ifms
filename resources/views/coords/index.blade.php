@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{asset('css/custom.css') }}">
@stop

@section('title', 'RematrículaIF - Coordenação')

@section('content_header')
    <h1>Área dos Coordenadores de Cursos</h1>
@stop

@section('content')
@include('layouts.errors')
@include('layouts.sucesso_session')
<div class="container-fluid">
    <div class="col-xs-12 col-sm-10 col-md-8">
        <table class="table hover" id="tabela">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Situação</th>
                    <th>Semestre</th>
                    <th>CR</th>
                    <th>Responável pelo cadastro</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registros as $registro)
                    <tr>
                        <td>{{$registro->nome}}</td>
                        <td>{{($registro->situacao == 1) ? "Dependência" : "Retido" }}</td>
                        <td>{{$registro->semestre}}</td>
                        <td>{{$registro->CR}}</td>
                        <td>{{$registro->usuario}}</td>
                        <td><a class="btn btn-primary" href="{{url('/coords/analisar/'.$registro->aluno_id)}}" target="_blank"> Ver</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{--  {{$registros->links()}}  --}}
    </div>
</div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#tabela').DataTable({
                "order": [[ 2, "asc"], [0, 'asc']],
                "lengthMenu": [[10, 25, 50, -1], [15, 25, 50, "Todos"]],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json"
                }
            });
        });
    </script>
@endsection