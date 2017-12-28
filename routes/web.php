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
    Route::post('/', 'CerelController@store');
    Route::get('/comprovante/{id}', 'CerelController@show');
    Route::get('/registrado/{id}', 'CerelController@edit');
});
// Route::resource('cerel', 'CerelController')->middleware('auth');
Route::resource('coords', 'CoordsController')->middleware('auth');

Route::group(['prefix' => 'admin'], function(){
    Route::resource('profile', 'ProfileController')->middleware('auth');
});

// Route::get('/cerel', 'HomeController@cerelIndex');
// Route::get('/coords', 'HomeController@coordsIndex');