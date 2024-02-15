<?php

use App\Http\Controllers\AdmController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FormasPagamentoController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\ServicoController;
use App\Http\Middleware\IsAuthentucated;
use App\Http\Middleware\SetSactumGuard;
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

//ADM
Route::post('/adm/cadastro', [ADMController::class, 'AdmCadastro']);
Route::post('adm/login', [ADMController::class, 'login']);

Route::get('/adm/teste', [ADMController::class, 'verificarUsuarioLogado'])->middleware([
    'auth:sanctum',
    SetSactumGuard::class,
    IsAuthentucated::class
]);

Route::delete('adm/delete/{id}', [ADMController::class, 'excluir']);
Route::put('adm/update', [ADMController::class, 'update']);
Route::post('adm/nome', [ADMController::class, 'pesquisarPorNome']);
Route::post('adm/senha/redefinir', [ADMController::class, 'redefinirSenha']);
//ADM Serviço
Route::post('adm/servico/cadastro', [ServicoController::class, 'criarServico']);
Route::post('adm/servico/nome', [ServicoController::class, 'pesquisaPorNome']);
Route::delete('adm/servico/delete/{id}', [ServicoController::class, 'excluir']);
Route::put('adm/servico/update', [ServicoController::class, 'update']);
//ADM Profissional
Route::post('adm/profissional/cadastro', [ProfissionalController::class, 'CadastroProfissional']);
Route::post('adm/profissional/nome', [ProfissionalController::class, 'pesquisarPorNome']);
Route::delete('adm/profissional/delete/{id}', [ProfissionalController::class, 'excluir']);
Route::put('adm/profissional/update', [ProfissionalController::class, 'update']);
Route::post('adm/profissional/senha/redefinir', [ProfissionalController::class, 'redefinirSenha']);
//ADM Horario



//ADM Forma de pagamento
Route::put('adm/editar/pagamento', [FormasPagamentoController::class,  'updatepagamento']);
Route::post('adm/cadastro/pagamento', [FormasPagamentoController::class, 'cadastroTipoPagamento']);
Route::post('adm/pesquisar/nome/pagamento', [FormasPagamentoController::class, 'pesquisarPorTipoPagamento']);
Route::delete('adm/delete/pagamento/{id}', [FormasPagamentoController::class, 'deletarPagamento']);
Route::get('adm/visualizar/pagamento', [FormasPagamentoController::class, 'visualizarCadastroTipoPagamento']);
Route::get('adm/visualizar/pagamento/habilitado', [FormasPagamentoController::class, 'visualizarCadastroPagamentoHabilitado']);
Route::get('adm/visualizar/pagamento/desabilitado', [FormasPagamentoController::class, 'visualizarCadastroPagamentoDesabilitado']);

//formas de pagamento
ROute::post('formaPagamento/criar', [FormasPagamentoController::class, 'cadastroTipoPagamento']);
Route::get('formaPagamento/PesquisarNome', [FormasPagamentoController::class, 'pesquisarPorTipoPagamento']);
Route::delete('formaPagamento/deletar/{id}', [FormasPagamentoController::class, 'deletarpagamento']);
Route::put('formaPagamento/update', [FormasPagamentoController::class, 'updatepagamento']);
Route::get('visualizar/pagamento', [FormasPagamentoController::class,'visualizarCadastroTipoPagamento']);
Route::get('visualizar/pagamentosAtivados',[FormasPagamentoController::class, 'visualizarCadastroTipoPagamentoHabilitado']);
Route::get('visualizar/pagamentosDesativados',[FormasPagamentoController::class, 'visualizarCadastroTipoPagamentoDesabilitado']);
