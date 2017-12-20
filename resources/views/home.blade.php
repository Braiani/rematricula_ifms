@extends('layouts.app')

@section('content')
<div class="container">
    {{--  @include('layouts.errors')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>  --}}
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Selecione a área de acesso:</div>

                <div class="panel-body">
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
            </div>
        </div>
    </div>
@endsection
