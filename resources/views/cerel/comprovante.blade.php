@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{asset('css/custom.css') }}">
@stop

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
@include('layouts.errors')
@include('layouts.sucesso_session')
    <p>Aqui será gerado o comprovante de registro de matrícula. (Em PDF)</p>
@stop