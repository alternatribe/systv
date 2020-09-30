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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/search/{search?}', 'SearchController@index')->name('pesquisa_get');
Route::post('/search', 'SearchController@search')->name('pesquisa');

Route::get('/acompanhamento', 'AcompanhamentoController@index')->name('lista');
Route::get('/acompanhamento/filme', 'AcompanhamentoController@createfilme')->name('filme');
Route::get('/acompanhamento/seriado', 'AcompanhamentoController@createseriado')->name('seriado');
Route::get('/acompanhamento/filme/editar', 'AcompanhamentoController@editarfilme')->name('editar_filme');
Route::get('/acompanhamento/seriado/editar', 'AcompanhamentoController@editarseriado')->name('editar_seriado');
Route::get('/acompanhamento/{id}', 'AcompanhamentoController@edit');
Route::post('/acompanhamento', 'AcompanhamentoController@store');
Route::get('/acompanhamento/{id}/remove', 'AcompanhamentoController@destroy');

Auth::routes();
Route::get('/login', 'UserController@index')->name('login')->middleware('guest');
Route::post('/login', 'UserController@login')->middleware('guest');
Route::get('/register', 'UserController@create')->name('register')->middleware('guest');
Route::post('/register', 'UserController@store')->middleware('guest');
Route::get('/password/reset', 'UserController@request')->name('password_request')->middleware('guest');
Route::get('/password/reset/{token}', 'UserController@reset')->name('password_reset')->middleware('guest');
Route::get('/logout', 'UserController@logout')->name('logout')->middleware('auth');
Route::delete('/login/remove', 'UserController@delete')->name('excluir_conta')->middleware('auth');


