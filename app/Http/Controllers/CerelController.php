<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aluno;
use App\DisciplinaCurso;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade as PDF;
use App\Registro;


class CerelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = Aluno::join('cursos', 'cursos.id', '=', 'alunos.id_curso')
                        //->join('alunos', 'alunos.id_curso', '=', 'cursos.id')
                        ->select('alunos.nome', 'cursos.nome as curso', 'alunos.matricula', 'alunos.id')
                        ->orderBy('nome', 'asc')->get();
        return view('cerel.index')->with('alunos', $alunos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if(count(Registro::where('id_alunos', '=', $id)->get()) > 0){
            return redirect('/cerel/registrado/' . $id);
        }
        $aluno = Aluno::join('cursos', 'cursos.id', '=', 'alunos.id_curso')
                        ->select('alunos.nome', 'cursos.nome as curso', 'alunos.matricula', 'alunos.id', 'alunos.id_curso as curso_id')
                        ->where('alunos.id', '=', $id)->get();

        $contadorSemestre = DisciplinaCurso::where('id_cursos', '=', $aluno[0]->curso_id)->max('semestre');
        for($i = 1; $i <= $contadorSemestre; $i++){
            $disciplinas[$i] = DisciplinaCurso::where([
                                ['id_cursos', '=',  $aluno[0]->curso_id],
                                ['semestre', '=', $i]
                            ])->get();
        }
        $registros = '';
        return view('cerel.registro', ['aluno' => $aluno, 'disciplinas' => $disciplinas, 'registros' => $registros]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'idAluno' => 'required',
            'disciplinas' => 'required',
            'semestre' => 'required',
            'situacao' => 'required'
        ]);
        // dd(request('disciplinas'));
        $disciplinas = request('disciplinas');
        foreach($disciplinas as $disciplina){
            Registro::create([
                'id_disciplina_cursos' => $disciplina,
                'id_alunos' => request('idAluno'),
                'semestre' => request('semestre'),
                'situacao' => request('situacao'),
                'id_user' => auth()->user()->id,
            ]);
        }
        
        Session::flash('sucesso', 'Registro salvo com sucesso');
        return Redirect::to('/cerel/comprovante/' . request('idAluno'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aluno = Aluno::find($id);
        $registros = Registro::join('disciplina_cursos', 'id_disciplina_cursos', '=', 'disciplina_cursos.id')
                            ->select('disciplina_cursos.nome as disciplina')
                            ->where('id_alunos', '=', $aluno->id)->get();

        return PDF::loadView('cerel.comprovante', ['aluno' => $aluno, 'registros' => $registros])->stream();
        //return view('cerel.comprovante', ['aluno' => $aluno, 'registros' => $registros]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aluno = Aluno::find($id);
        $registros = Registro::join('disciplina_cursos', 'id_disciplina_cursos', '=', 'disciplina_cursos.id')
                            ->select('disciplina_cursos.nome as disciplina', 'registros.id as id')
                            ->where('id_alunos', '=', $aluno->id)->get();   
        return view('cerel.mostrar', ['aluno' => $aluno, 'registros' => $registros]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $aluno = Aluno::join('cursos', 'cursos.id', '=', 'alunos.id_curso')
                        ->select('alunos.nome', 'cursos.nome as curso', 'alunos.matricula', 'alunos.id', 'alunos.id_curso as curso_id')
                        ->where('alunos.id', '=', $id)->get();

        $contadorSemestre = DisciplinaCurso::where('id_cursos', '=', $aluno[0]->curso_id)->max('semestre');
        for($i = 1; $i <= $contadorSemestre; $i++){
            $disciplinas[$i] = DisciplinaCurso::where([
                                ['id_cursos', '=',  $aluno[0]->curso_id],
                                ['semestre', '=', $i]
                            ])->get();
        }
        $registros = Registro::join('disciplina_cursos', 'id_disciplina_cursos', '=', 'disciplina_cursos.id')
                            ->select('disciplina_cursos.nome as nomeDisciplina', 'disciplina_cursos.id as id_disciplinas', 'registros.situacao')
                            ->where('id_alunos', '=', $aluno[0]->id)->get();
        return view('cerel.alterar', ['aluno' => $aluno, 'disciplinas' => $disciplinas, 'registros' => $registros]);
    }

    public function salvar_update(Request $request){
        $this->validate(request(), [
            'idAluno' => 'required',
            'disciplinas' => 'required',
            'semestre' => 'required',
            'situacao' => 'required'
        ]);
        // dd(request('disciplinas'));
        $disciplinas = request('disciplinas');
        foreach($disciplinas as $disciplina){
            
            if(Registro::where('id_disciplina_cursos', $disciplina)->count() == 0){
                Registro::create([
                    'id_disciplina_cursos' => $disciplina,
                    'id_alunos' => request('idAluno'),
                    'semestre' => request('semestre'),
                    'situacao' => request('situacao'),
                    'id_user' => auth()->user()->id,
                ]);
            }
        }
        
        Session::flash('sucesso', 'Registro salvo com sucesso');
        return Redirect::to('/cerel/comprovante/' . request('idAluno'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registro = Registro::find($id);
        $aluno_id = $registro->id_alunos;
        if($registro->id_user == auth()->user()->id || auth()->user()->perfil == 3){
            $registro->delete();
            Session::flash('sucesso', 'Registro removido com sucesso');
            return redirect('/cerel/registrado/'. $aluno_id);
        }
        
        return redirect('/cerel/registrado/'. $aluno_id)->withErrors('Você não tem permissão para remover o registro');
    }
}
