<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aluno;
use App\Registro;
use Illuminate\Support\Facades\Session;

class CoordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registros = Registro::join('disciplina_cursos', 'disciplina_cursos.id', '=', 'registros.id_disciplina_cursos')
                            ->join('alunos', 'alunos.id', '=', 'registros.id_alunos')
                            ->join('users', 'users.id', '=', 'registros.id_user')
                            ->select('alunos.nome', 'registros.semestre', 'registros.situacao', 'users.nome as usuario',
                             'alunos.id as aluno_id', 'alunos.CR as CR')
                            ->groupBy('registros.id_alunos')->get();
        return view('coords.index')->with('registros', $registros);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $registros = Registro::join('disciplina_cursos', 'disciplina_cursos.id', '=', 'registros.id_disciplina_cursos')
                            ->join('alunos', 'alunos.id', '=', 'registros.id_alunos')
                            ->join('users', 'users.id', '=', 'registros.id_user')
                            ->select('alunos.nome', 'registros.semestre', 'registros.situacao', 'registros.id', 
                            'disciplina_cursos.nome as disciplina', 'registros.avaliacao', 'alunos.CR as CR')
                            ->where('registros.id_alunos', '=', $id)->paginate(10);
        return view('coords.show')->with('registros', $registros);
    }

    public function update_aceito($id){
        if(auth()->user()->perfil <> 2 || auth()->user()->perfil <> 2){
            return back()->withErrors('Você não tem permissão para essa ação!');
        }
        if(Registro::find($id)->update(['avaliacao' => 1])){
            Session::flash('sucesso', 'Registro salvo com sucesso');
            return back();
        }
        return back()->withErrors('Ocorreu um erro ao tetar salvar o registro!');
    }

    public function update_rejeitado($id){
        if(auth()->user()->perfil <> 2 || auth()->user()->perfil <> 2){
            return back()->withErrors('Você não tem permissão para essa ação!');
        }
        if(Registro::find($id)->update(['avaliacao' => 2])){
            Session::flash('sucesso', 'Registro salvo com sucesso');
            return back();
        }
        return back()->withErrors('Ocorreu um erro ao tetar salvar o registro!');
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
