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
    try {
        DB::connection()->getPdo();
    } catch (\Exception $e) {
        die("Não foi possível conectar ao banco de dados. Favor ler o arquivo readme.md para realizar a configuração necessária.");
    }
    return view('contact_form/form');
});

Route::post('contato', 'ContatoController@store')->name('contato.store');
