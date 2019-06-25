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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@home');

//Auth::routes();

// Authentication Routes...
Route::post('login', 'Auth\LoginController@authenticate')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/pacientes/listar', 'PacienteController@index')->name('pacientes.index');
Route::post('/pacientes/listar', 'PacienteController@index')->name('pacientes.index.busca');
Route::get('/pacientes/cadastrar', 'PacienteController@create')->name('pacientes.cadastro');
Route::post('/pacientes/cadastrar', 'PacienteController@store')->name('pacientes.cadastro.enviar');
Route::get('/pacientes/{id}/editar', 'PacienteController@show')->name('pacientes.editar');
Route::put('/pacientes/{id}/editar', 'PacienteController@update')->name('pacientes.editar.update');
Route::delete('/pacientes/{id}/excluir', 'PacienteController@destroy')->name('pacientes.destroy');

Route::get('/pacientes/{id}/liberacoes/', 'LiberacoesController@index')->name('liberacoes.index');
Route::get('/pacientes/{id}/liberacoes/print/{idliberacao}/autorizacao', 'LiberacoesController@autorizacao')->name('liberacoes.autorizacao');
Route::get('/pacientes/{id}/liberacoes/print/{idliberacao}/guiafatura', 'LiberacoesController@guiafatura')->name('liberacoes.guiafatura');
Route::get('/pacientes/{id}/liberacoes/{idliberacao}/detalhes', 'LiberacoesController@show')->name('liberacoes.detalhes');
Route::delete('/pacientes/{id}/liberacoes/{idliberacao}/excluir', ['uses' =>  'LiberacoesController@destroy', 'nocsrf' => true])->name('liberacoes.excluir');
Route::post('/pacientes/{id}/liberacoes/registrar', 'LiberacoesController@store')->name('liberacoes.store');

Route::get('/relatorios', 'RelatoriosController@index')->name('relatorios');
Route::post('/relatorios/gerar', 'RelatoriosController@gerar')->name('relatorios.gerar');

Route::get('/gerarSenha', function() {
    return bcrypt('753159');
});
//Route::get('/atualizapacientes/', 'PacienteController@atualizaRegistros');
//Route::get('/codigoliberacao/', 'LiberacoesController@codigoliberacao');

