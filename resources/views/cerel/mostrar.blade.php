@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{asset('css/custom.css') }}">
@stop

@section('title', 'Registro Realizado')

@section('content_header')
    <h1>Registro já realizado - {{$aluno->nome}}</h1>
@stop

@section('content')
@include('layouts.errors')
@include('layouts.sucesso_session')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-md-8">
                <h3>Foram encontrados os seguintes registros para o(a) estudante selecionado:</h3>
                <div class="row">
                    <div class="pull-right">
                        <a href="{{url('/cerel/registrado/'.$aluno->id . '/editar')}}" class="btn btn-success">+ Adicionar disciplina</a>
                        <a href="{{url('/cerel/comprovante/'.$aluno->id)}}" class="btn btn-primary">Imprimir comprovante</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Disciplina</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($registros as $registro)
                                <tr>
                                    <td>{{$registro->disciplina}}</td>
                                    <td>
                                        <form action="{{url('/cerel/'.$registro->id)}}" class="form pull-right" method="POST">
                                            {{method_field('DELETE')}}
                                            {{csrf_field()}}
                                            <button class="btn btn-danger" type="submit">Apagar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.form').on('submit', function () {

                var confirmado = confirm('Tem certeza que deseja excluir?');
            
                if (! confirmado) return false;
            });           
        });
    </script>
@endsection