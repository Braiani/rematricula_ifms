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
        <form action="{{ url('/cerel')}}" method="POST" clas="form-inline">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="nomeAluno">Estudante:</label>
                <p>{{$aluno[0]->nome}} - {{$aluno[0]->matricula}} - {{$aluno[0]->curso}}</p>
                {{--  <input type="text" class="form-control" name="nomeAluno" value="{{$aluno->nome}}" disabled>  --}}
                <input type="text" class="hidden" name="idAluno" value="{{$aluno[0]->id}}">                    
            </div>
            
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-md-10 col-lg-8">
                    @foreach ($disciplinas as $semestre)
                    <div class="form-group border">
                        <h3>{{$semestre[0]->semestre}}º semestre</h3>
                        @foreach ($semestre as $disciplina)
                        {{--  <div class="form-group ">  --}}
                        <label>
                            <input type="checkbox" name="disciplinas[]" value="{{$disciplina->id}}" > {{$disciplina->nome}}
                        </label>
                        {{--  </div>  --}}
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
</div>
@stop