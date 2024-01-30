<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfissionalFormrequest;
use App\Http\Requests\ProfissionalFormRequestUpdate;
use App\Models\ProfissionalModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfissionalController extends Controller
{
    public function CadastroProfissional(ProfissionalFormrequest $request)
    {
        $profissional = ProfissionalModel::create([
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
            'password' => $request->password,
            'salario' => $request->salario,
          
        ]);
        return response()->json([
            "success" => true,
            "message" => "Profissional cadastrado.",
            "data" => $profissional
        ], 200);
    }

    public function recuperarSenha(Request $request)
    {
        $profissional = ProfissionalModel::where('id', $request->id)->first();
        if (isset($profissional)) {
            $profissional->password = Hash::make($profissional->cpf);
            $profissional->update();
            return response()->json([
                'status' => true,
                'message' => 'senha redefinid.'
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'não foi possivel alterar sua senha.'
        ]);
    }
    public function pesquisarPorNome(Request $request)
    {
        $profissional= ProfissionalModel::where('nome', 'like', '%' .$request->nome . '%')->get();
        if (count($profissional) > 0) {
            return response()->json([
                'status' => true,
                'date' => $profissional
            ]);
        } 
        return response()->json([
            'status' =>false,
            'message' => 'Não háresultados para sua pesquisa.'

        ]);
    }
    public function exclui($id)
    {
        
        $profissional = ProfissionalModel::find($id);
        if (!isset($profissional)) {
            return response()->json([
                'status' => false,
                'message' => "profissional não encontrado"
            ]);
        }

        $profissional->delete();
        return response()->json([
            'status' => true,
            'message' => "profissional excluído com sucesso"
        ]);
    }

    public function update(ProfissionalFormRequestUpdate $request)
    {
        $profissional = ProfissionalModel::find($request->id);

        if (!isset($profissional)) {
            return response()-> json([
                'status' => false,
                'message' => "profissional nao encontrado."
            ]);
        }
        if(isset($request->nome)){
            $profissional-> nome = $request->nome;
            }
            if(isset($request->celular)){
            $profissional-> celular = $request->celular;
            }
            if(isset($request->email)){
            $profissional-> email = $request->email;
            }
            if(isset($request->cpf)){
            $profissional-> cpf = $request->cpf;
            }
            if(isset($request->nascimento)){
                $profissional-> nascimento = $request->nascimento;
            }
            if(isset($request->cidade)){
                $profissional-> cidade = $request->cidade;
            }
            if(isset($request->estado)){
                $profissional-> estado = $request->estado;
            }
            if(isset($request->pais)){
                $profissional-> pais = $request->pais;
            }
            if(isset($request->rua)){
                $profissional-> rua = $request->rua;
            }
            if(isset($request->numero)){
                $profissional-> numero = $request->numero;
            }
            if(isset($request->bairro)){
                $profissional-> bairro = $request->bairro;
            }
            if(isset($request->cep)){
                $profissional-> cep = $request->cep;
            }
            if(isset($request->complemento)){
                $profissional-> complemento = $request->complemneto;
            }
            if(isset($request->password)){
                $profissional-> password = $request->password;
            }
            if(isset($request->salario)){
                $profissional-> salario = $request->salario;
            }

            $profissional->update();
            return response()->json([
                'status' => true,
            'message' => "profissional atualizado."
            ]);
    }

}
