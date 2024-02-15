<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteFormRequest;
use App\Http\Requests\ClienteFormRequestUpdate;
use App\Models\cliente;
use App\Models\ClienteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    public function criarCliente(ClienteFormRequest $request)
    {
        $cliente = ClienteModel::create([
            'nome' => $request->nome,
            'celular' => $request->celular,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'nascimento' => $request->nascimento,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'pais' => $request->pais,
            'rua' => $request->rua,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'cep' => $request->cep,
            'complemento' => $request->complemento,
            'password' => $request->password
        ]);
        return response()->json([
            "success" => true,
            "message" => "Cliente cadastrado",
            "data" => $cliente
        ], 200);
    }
    public function pesquisaPorNome(Request $request)
    {
        $cliente = ClienteModel::where('nome', 'like', '%' . $request->nome . '%')->get();

        if (count($cliente) > 0) {

            return response()->json([
                'status' => true,
                'data' => $cliente
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultado para pesquisa.'
        ]);
    }

    
    public function redefinirSenha(Request $request)
    {
        $cliente =  ClienteModel::where('email', $request->email)->first();
        $cliente =  ClienteModel::where('cpf', $request->cpf)->first();

        if (!isset($cliente)) {
            return response()->json([
                'status' => false,
                'message' => "Cliente não encontrado"
            ]);
        }

        $cliente->password = Hash::make($cliente->cpf);
        $cliente->update();

        return response()->json([
            'status' => false,
            'message' => "Sua senha foi atualizada"
        ]);
    }


   
    public function exclui($id)
    {
        
        $cliente = ClienteModel::find($id);
        if (!isset($cliente)) {
            return response()->json([
                'status' => false,
                'message' => "Cliente não encontrado"
            ]);
        }

        $cliente->delete();
        return response()->json([
            'status' => true,
            'message' => "Cliente excluído com sucesso"
        ]);
    }
    public function update(ClienteFormRequestUpdate $request)
    {
        $cliente = ClienteModel::find($request->id);

        if (!isset($cliente)) {
            return response()->json([
                'status' => false,
                'message' => "Cliente não encontrado"
            ]);
        }
       
        if(isset($request->nome)){
        $cliente-> nome = $request->nome;
        }
        if(isset($request->celular)){
        $cliente-> celular = $request->celular;
        }
        if(isset($request->email)){
        $cliente-> email = $request->email;
        }
        if(isset($request->cpf)){
        $cliente-> cpf = $request->cpf;
        }
        if(isset($request->nascimento)){
            $cliente-> nascimento = $request->nascimento;
        }
        if(isset($request->cidade)){
            $cliente-> cidade = $request->cidade;
        }
        if(isset($request->estado)){
            $cliente-> estado = $request->estado;
        }
        if(isset($request->pais)){
            $cliente-> pais = $request->pais;
        }
        if(isset($request->rua)){
            $cliente-> rua = $request->rua;
        }
        if(isset($request->numero)){
            $cliente-> numero = $request->numero;
        }
        if(isset($request->bairro)){
            $cliente-> bairro = $request->bairro;
        }
        if(isset($request->cep)){
            $cliente-> cep = $request->cep;
        }
        if(isset($request->complemento)){
            $cliente-> complemento = $request->complemneto;
        }
        if(isset($request->password)){
            $cliente-> password = $request->password;
        }


        $cliente->update();

        return response()->json([
            'status' => true,
            'message' => "Cliente atualizado."
        ]);
       
    }
    public function retornarTudo(){
        $cliente = ClienteModel::all();

        if(count($cliente)==0){
            return response()->json([
                'status'=> false,
                'message'=> "serviço nao encontrado"
            ]);
        }
        return response()->json([
            'status'=> true,
            'data' => $cliente
        ]);
       }
    
}
