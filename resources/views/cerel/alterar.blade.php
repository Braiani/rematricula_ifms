@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{asset('css/registro.css') }}">
@stop

@section('title', 'RemarículaIF - CEREL')

@section('content_header')
    <h1>Registro de Intenção</h1>
@stop

@section('content')
@include('layouts.errors')
<div class="row">
    <div class="container-fluid">
        <form action="{{ url('/cerel/registrado/' . $aluno[0]->id)}}" method="POST" clas="form-inline">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="nomeAluno">Estudante:</label>
                <p>{{$aluno[0]->nome}} - {{$aluno[0]->matricula}} - {{$aluno[0]->curso}}</p>
                {{--  <input type="text" class="form-control" name="nomeAluno" value="{{$aluno->nome}}" disabled>  --}}
                <input type="text" class="hidden" name="idAluno" value="{{$aluno[0]->id}}">                    
            </div>
            <div class="col-xs-12 col-sm-10 col-md-6 col-lg-4">
                <div class="form-group{{ $errors->has('situacao') ? ' has-error' : '' }}">
                    <label for="situacao">Situação do estudante:</label>
                    <select name='situacao' class='form-control select-situacao'>
                        <option></option>
                        <option value="1" {{ $registros[0]->situacao == 1 ? 'selected': '' }}>Dependência</option>
                        <option value="2" {{ $registros[0]->situacao == 2 ? 'selected': '' }}>Retido</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-10 col-md-6 col-lg-4">
                    <div class="form-group{{ $errors->has('semestre') ? ' has-error' : '' }}">
                        <label for="semestre">Semestre de rematrícula:</label>
                        <select name='semestre' class='form-control select-semestre'>
                            <option value="20181">2018/1</option>
                        </select>
                    </div>
                </div>
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-md-10 col-lg-8">
                    @foreach ($disciplinas as $semestre)
                    <div class="form-group{{ $errors->has('disciplinas') ? ' has-error' : '' }} border">
                        <h3>{{$semestre[0]->semestre}}º semestre</h3>
                        @foreach ($semestre as $disciplina)
                        <label>
                            <input type="checkbox" name="disciplinas[]" value="{{$disciplina->id}}"> {{$disciplina->nome}}
                        </label>
                        @endforeach
                    </div>
                    @endforeach
                <div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Salvar registro</button>
            </div>
            </div>
        </form>
    </div>
    <div class="alert alert-info fixed-message">
        <p><b>Disciplinas já cadastradas:</b></p>
        @foreach ($registros as $registro)
            <p>{{$registro->nomeDisciplina}}</p>
        @endforeach
    </div>
</div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.select-situacao').select2({
                placeholder: "Selecione a situação do estudante",
                allowClear: true
            });
            $('.select-semestre').select2({
                placeholder: "Selecione o semestre da rematrícula",
                allowClear: true
            });            
        });
    </script>
@endsection