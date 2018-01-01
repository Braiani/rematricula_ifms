<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(Auth::check()){
        return redirect('/home');
    }else{
        return view('welcome');
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'cerel', 'middleware' => 'auth'], function(){
    Route::get('/', 'CerelController@index');
    Route::get('/{id}', 'CerelController@create');
    Route::delete('/{id}', 'CerelController@destroy');
    Route::post('/', 'CerelController@store');
    Route::get('/comprovante/{id}', 'CerelController@show');
    Route::get('/registrado/{id}', 'CerelController@edit');
    Route::get('/registrado/{id}/editar', 'CerelController@update');
    Route::post('/registrado/{id}', 'CerelController@salvar_update');
});

Route::group(['prefix' => 'coords', 'middleware' => 'auth'], function(){
    Route::get('/', 'CoordsController@index');
    Route::get('/analisar/{id}', 'CoordsController@update');
    Route::get('/analisar/{id}/acepted', 'CoordsController@update_aceito');
    Route::get('/analisar/{id}/declined', 'CoordsController@update_rejeitado');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    Route::get('perfil', 'ProfileController@index');
    Route::post('perfil', 'ProfileController@store');
    Route::get('adicionar', 'HomeController@addUser');
});

// Route::get('/cerel', 'HomeController@cerelIndex');
// Route::get('/coords', 'HomeController@coordsIndex');