<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aluno;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('home');
    }

    public function cerelIndex()
    {
        if(auth()->user()->perfil == 1 || auth()->user()->perfil == 3){
            $alunos = ALuno::all();
            return View('cerel.home', compact('alunos'));
        }else{
            return redirect('home');
        }
        
    }

    public function coordsIndex()
    {
        if(auth()->user()->perfil == 2 || auth()->user()->perfil == 3){
            $alunos = ALuno::all();
            return View('coords.home', compact('alunos'));
        }else{
            return redirect('home');
        }
        
    }
}
