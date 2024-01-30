<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ProfissionalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//profissionais
Route::post('profissional/criar', [ProfissionalController::class, 'CadastroProfissional']);
Route::put('profissional/esqueciSenha/{id}',[ProfissionalController::class, 'recuperarSenha']);
Route::post('profissional/pesquisarNome',[ProfissionalController::class, 'pesquisarPorNome']);
Route::delete('profissional/deletar/{id}',[ProfissionalController::class, 'exclui']);
Route::put('profissional/atualizar', [ProfissionalController::class, 'update']);
//agenda
Route::post('agenda/criar', [AgendaController::class, 'criarAgenda']);
Route::post('agenda/criar/horario', [AgendaController::class, 'criarHorarioProfissional']);
Route::post('agenda/pesquisaDataHora',[AgendaController::class, 'pesquisarPorDataDoProfissional']);