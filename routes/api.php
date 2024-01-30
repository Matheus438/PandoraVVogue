<?php

use App\Http\Controllers\AdmController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FormasPagamentoController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\ServicoController;
use App\Models\FormasPagamento;
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
Route::get('agenda/retornaTodos', [AgendaController::class, 'retornarTudo']);
Route::delete('agenda/delete/{id}',[AgendaController::class, 'excluiAgenda']);
Route::put('agenda/update', [AgendaController::class, 'updateAgenda']);
//cliente
Route::post('cliente/criar', [ClienteController::class, 'criarCliente']);
Route::post('cliente/pesquisarPorNome',[ClienteController::class, 'pesquisaPorNome']);
Route::put('cliente/esqueciSenha/{id}',[ClienteController::class, 'esqueciSenha']);
Route::delete('cliente/delete/{id}',[ClienteController::class, 'exclui']);
Route::put('cliente/update', [ClienteController::class, 'update']);
Route::get('cliente/retornarTudo', [ClienteController::class, 'retornarTudo']);
//serviço
Route::post('servico/criar', [ServicoController::class, 'criarServico']);
Route::post('servico/pesquisarNome',[ServicoController::class, 'pesquisaPorNome']);
Route::delete('servico/deletar/{id}',[ServicoController::class, 'excluir']);
Route::put('servico/atualizar', [ServicoController::class, 'update']);
Route::get('servico/retornarTodos', [ServicoController::class, 'retornarTodos']);
//adm
Route::post('adm/cadastro', [AdmController::class, 'ADMcadastro']);
Route::delete('adm/delete/{id}', [ADMController::class, 'excluir']);
Route::put('adm/update', [ADMController::class, 'update']);
Route::post('adm/pesquisaNome', [ADMController::class, 'pesquisarPorNome']);
Route::post('adm/senha/redefinir',[ADMController::class, 'redefinirSenha']);

//formas de pagamento
ROute::post('formaPagamento/criar', [FormasPagamentoController::class, 'cadastroTipoPagamento']);
Route::get('formaPagamento/PesquisarNome', [FormasPagamentoController::class, 'pesquisarPorTipoPagamento']);
Route::delete('formaPagamento/deletar/{id}', [FormasPagamentoController::class, 'exclui']);
Route::put('formaPagamento/update', [FormasPagamentoController::class, 'updatepagamento']);