@extends('layouts.app') 

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10  col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Registrar intenção de matrícula</div>
                    <div class="panel-body">
                        <form class="form-horizontal">
                            <!-- Select Basic -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="selectbasic">Escolha o estudante</label>
                                <div class="col-md-8">
                                    <select id="selectbasic" name="selectbasic" class="form-control">
                                        @foreach($alunos as $aluno)
                                        <option value="{{ $aluno->matricula }}">{{ $aluno->nome }} - {{ $aluno->curso }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection