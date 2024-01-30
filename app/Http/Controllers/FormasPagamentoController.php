<?php 

 

namespace App\Http\Controllers;

use App\Http\Requests\FormasPagamentoFormRequest;
use App\Http\Requests\FormasPagamentoFormRequestUpdate;
use App\Http\Requests\PagamentoFormRequest; 

use App\Http\Requests\PagamentoFormRequestUpdate;
use App\Models\FormasPagamento;
use App\Models\Pagamento; 

use Illuminate\Http\Request; 

 

class FormasPagamentoController extends Controller 

{ 

    public function cadastroTipoPagamento(FormasPagamentoFormRequest $request) 

    { 

        $pagamento = FormasPagamento::create([ 

            'nome' => $request->nome, 

            'taxa' => $request->taxa, 

        ]); 

 

        return response()->json([ 

            "success" => true, 

            "message" => "Pagamento cadastrado com êxito", 

            "data" => $pagamento 

        ], 200); 

    } 

 

    public function pesquisarPorTipoPagamento(Request $request) 

    { 

        $pagamento = FormasPagamento::where('nome', 'like', '%' . $request->nome . '%')->get(); 

         

        if (count($pagamento)) { 

            return response()->json([ 

                'status' => true, 

                'data' => $pagamento 

            ]); 

        } 

 

        return response()->json([ 

            'status' => false, 

            'data' => "Pagamento não encontrado" 

        ]); 

    } 

     

    public function exclui($id)
    {
        
        $pagamento = FormasPagamento::find($id);
        if (!isset($pagamento)) {
            return response()->json([
                'status' => false,
                'message' => "Forma de pagamento não encontrado"
            ]);
        }

        $pagamento->delete();
        return response()->json([
            'status' => true,
            'message' => "Forma de pagamento excluído com sucesso"
        ]);
    }

    

     

    public function updatepagamento(FormasPagamentoFormRequestUpdate $request) 

    { 

        $pagamento = FormasPagamento::find($request->id); 

        if (!isset($pagamento)) { 

            return response()->json([ 

                'status' => false, 

                'message' => 'Pagamento não encontrado' 

            ]); 

        } 

         

        if (isset($request->nome)) { 

            $pagamento->nome = $request->nome; 

        } 

         

        if (isset($request->taxa)) { 

            $pagamento->taxa = $request->taxa; 

        } 

         

        $pagamento->update(); 

        return response()->json([ 

            'status' => true, 

            'message' => 'Tipo de pagamento atualizado' 

        ]); 

    } 

     

    public function visualizarCadastroTipoPagamento() 

    { 

        $pagamento = FormasPagamento::all(); 

        if (!isset($pagamento)) { 

            return response()->json([ 

                'status' => false, 

                'message' => 'Não há registros no sistema' 

            ]); 

        } 

         

        return response()->json([ 

            'status' => true, 

            'data' => $pagamento 

        ]); 

    } 

} 

 