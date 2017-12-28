<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aluno;
use App\DisciplinaCurso;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


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
        return view('cerel.registro', ['aluno' => $aluno, 'disciplinas' => $disciplinas]);
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
            'disciplinas' => 'required'
        ]);
        //dd($request->all());
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
        return view('cerel.comprovante');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('cerel.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
