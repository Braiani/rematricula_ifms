@extends('layouts.app')

@section('content')
<div class="container">
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
    </div>
    <div class="row">
        <div class="col-md-8  col-md-offset-2">
            <div class="panel panel-default">
                <form class="form-horizontal">
                   <div class="panel-heading">
                        <!-- Form Name -->
                        <legend>Registrar intenção de matrícula</legend>
                    </div>
                    <div class="panel-body">
                        <!-- Select Basic -->
                        <div class="form-group">
                        <label class="col-md-4 control-label" for="selectbasic">Escolha o estudante</label>
                        <div class="col-md-4">
                            <select id="selectbasic" name="selectbasic" class="form-control">
                            @foreach($alunos as $aluno)
                                <option value="{{ $aluno->matricula }}">{{ $aluno->nome }} - {{ $aluno->curso }}</option>
                            @endforeach
                            </select>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
