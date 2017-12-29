@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{asset('css/custom.css') }}">
@stop

@section('title', 'RemarículaIF - CEREL')

@section('content_header')
    <h1>Registro de Intenção</h1>
@stop

@section('content')
@include('layouts.errors')
@include('layouts.sucesso_session')
<div class="row">
    <div class="col-sm-10 col-md-8">
        <h3>Por favor, Selecione o estudante abaixo.</h3>
        <div class="form-group">
            <select id="aluno" name="aluno" class="form-control select">
                <option value=''>-- Selecione o aluno --</option>
                @foreach ($alunos as $aluno)
                    <option value="{{$aluno->id}}">{{$aluno->nome}} - {{$aluno->curso}} - {{$aluno->matricula}}</option>
                @endforeach
            </select>
        </div>
        <a class="btn btn-primary btn-lg" id="btnRegistro" target="_blank" href="javascrip:void(0);">Registrar</a>
    </div>
</div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.select').select2();
            $('#aluno').on('change', function(){
                //alert($(this).val());
                if($(this).val() !== ""){
                    $('#btnRegistro').attr('href', '/cerel/' + $(this).val());
                }else{                    
                    $('#btnRegistro').attr('href', 'javascrip:void(0);');
                }
            });
        });
    </script>
@endsection