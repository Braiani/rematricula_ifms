<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.profile');
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
        $this->validate(request(), [
            'id_usuario' => 'required',
            'nome' => 'required',
            'siape' => 'required',
            'senha' => 'required|confirmed|min:5',
        ]);
        if(request('id_usuario') <> auth()->user()->id){
            return view('admin.profile')->withErrors('Um erro ocorreu durante a atualização das informações.');
        }
        $atualizar = User::find(auth()->user()->id)->update([
            'nome' => request('nome'),
            'siape' => request('siape'),
            'password' => bcrypt(request('senha')),
        ]);
        if(!$atualizar){
            return view('admin.profile')->withErrors('Um erro ocorreu durante a atualização das informações.');
        }
        Session::flash('sucesso', 'Registro salvo com sucesso');
        return view('admin.profile');
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
