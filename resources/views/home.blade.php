@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{asset('css/custom.css') }}">
@stop

@section('title', 'RematrículaIF')

@section('content_header')
    <h1>Selecione a área de acesso:</h1>
@stop

@section('content')
<div class="panel-body content-center">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-1">
            <div class="thumbnail">
                <div class="caption">
                    <h3>CEREL - Registro</h3>
                    <p>Servidor da CEREL, utilizar essa página para registrar as intenções de DPs</p>
                    <p><a href="{{ url('/cerel') }}" class="btn btn-primary" role="button">Acessar</a> </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-md-offset-1">
            <div class="thumbnail">
                <div class="caption">
                    <h3>Coords - Avaliação</h3>
                    <p>Coordenador de Curso, utilizar essa página para análise das solicitações</p>                                    
                    <p><a href="{{ url('/coords') }}" class="btn btn-primary center" role="button">Acessar</a> </p>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
