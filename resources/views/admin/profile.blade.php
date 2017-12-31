@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{asset('css/custom.css') }}">
@stop

@section('title', 'RematrículaIF')

@section('content_header')
    <h1>Atualizar as informações do perfil</h1>
@stop

@section('content')
@include('layouts.errors')
@include('layouts.sucesso_session')
<div class="container-fluid">
    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-4">

        <form action="/admin/perfil" class="form-horizontal" method="POST">
            {{csrf_field()}}
            <input type="hidden" name="id_usuario" value="{{auth()->user()->id}}">
            <div class="form-group">
                <label for="nome">
                    Nome:
                </label>
                <input type="text" class="form-control" name="nome" required value="{{auth()->user()->nome}}">
            </div>
            <div class="form-group">
                <label for="siape">
                    SIAPE:
                </label>
                <input type="text" class="form-control" name="siape" required value="{{auth()->user()->siape}}">
            </div>
            <div class="form-group">
                <label for="senha">
                    Senha:
                </label>
                <input type="password" class="form-control" name="senha" required autofocus>
            </div>
            <div class="form-group">
                <label for="senha_confirmation">
                    Confirmação da senha:
                </label>
                <input type="password" class="form-control" name="senha_confirmation" required>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Atualizar</button>
            </div>
        </form>
    </div>
</div>
@stop