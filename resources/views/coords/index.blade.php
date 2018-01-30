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
    <div class="col-sm-12 col-md-12 col-lg-12">
        <table class="table table-hover" id="tabela">
            <thead>
                <tr>
                    <th>Estudante</th>
                    <th>Matrícula</th>
                    <th>CR</th>
                    <th>Curso</th>
                    <th>Situação</th>
                    <th>Semestre</th>
                    <th>Responsável pelo cadastro</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registros as $registro)
                    <tr>
                        <td>{{$registro->nome}}</td>
                        <td>{{$registro->matricula}}</td>
                        <td>{{$registro->CR}}</td>
                        <td>{{$registro->curso}}</td>
                        <td>{{($registro->situacao == 1) ? "Dependência" : "Retido" }}</td>
                        <td>{{$registro->semestre}}</td>
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
                "order": [[1, 'asc'], [ 2, "desc"]],
                "lengthMenu": [[10, 25, 50, -1], [15, 25, 50, "Todos"]],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json"
                }
            });
        });
    </script>
@endsection