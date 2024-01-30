<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServicoFormRequest;
use App\Http\Requests\ServicoFormRequestUpdate;
use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function criarServico(ServicoFormRequest $request)
    {
        $servico = Servico::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'duracao' => $request->duracao,
            'preco' => $request->preco,
        ]);

        return response()->json([
            "success" => true,
            "message" => "Serviço cadastrado",
            "data" => $servico
           
        ], 200);
         
        if (count($servico) > 0) {
            return response()->json([
                'status' => false,
                "message" => "O Serviço contem mais de 200 caracteres, e não pode ser cadastrado",
                'data' => $servico
            ]);
        }
    }
    public function pesquisaPorNome(Request $request)
    {
        $servico = Servico::where('nome', 'like', '%' . $request->nome . '%')->get();

        if (count($servico) > 0) {

            return response()->json([
                'status' => true,
                'data' => $servico
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultado para pesquisa.'
        ]);
    }
    public function excluir($id)
    {
        $servico = Servico::find($id);
        if (!isset($servico)) {
            return response()->json([
                'status' => false,
                'message' => "Serviço não encontrado"
            ]);
        }

        $servico->delete();
        return response()->json([
            'status' => true,
            'message' => "Serviço excluído com sucesso"
        ]);
    }

    public function update(ServicoFormRequestUpdate $request)
    {
        $servico = Servico::find($request->id);

        if (!isset($servico)) {
            return response()->json([
                'status' => false,
                'message' => "Serviço não encontrado"
            ]);
        }
        
        if(isset($request->nome)){
        $servico-> nome = $request->nome;
        }
        if(isset($request->descricao)){
        $servico-> descricao = $request->descricao;
        }
        if(isset($request->duracao)){
        $servico-> duracao = $request->duracao;
        }
        if(isset($request->preco)){
        $servico-> preco = $request->preco;
        }

        $servico->update();

        return response()->json([
            'status' => true,
            'message' => "Serviço atualizado."
        ]);
        
    }
    public function retornarTodos(){
        $servico = Servico::all();

        if(count($servico)==0){
            return response()->json([
                'status'=> false,
                'message'=> "serviço nao encontrado"
            ]);
        }
        return response()->json([
            'status'=> true,
            'data' => $servico
        ]);
       }
}
