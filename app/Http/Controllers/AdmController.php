<?php

namespace App\Http\Controllers;

use App\Http\Requests\ADMFormRequest;
use App\Http\Requests\ADMFormRequestUpdate;
use App\Models\Adm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdmController extends Controller
{
    public function AdmCadastro(Request $request)
    {
        try {
            $data = $request->all(); 
            $data['password'] = Hash::make($request->password);
            $response = Adm::create($data)->createToken($request->server('HTTP_USER_AGENT'))->plainTextToken;
            return response()->json([
                'status' => 'success',
                'message' => "ADM cadastrado",
                'token' => $response
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    
    public function redefinirSenha(Request $request)
    {
        $ADM =  Adm::where('email', $request->email)->first();
        $ADM =  Adm::where('cpf', $request->cpf)->first();

        if (!isset($ADM)) {
            return response()->json([
                'status' => false,
                'message' => "ADM não encontrado"
            ]);
        }

        $ADM->password = Hash::make($ADM->cpf);
        $ADM->update();

        return response()->json([
            'status' => false,
            'message' => "Sua senha foi atualizada"
        ]);
    }



    public function excluir($id)
    {
        $ADM  = Adm ::find($id);
        if (!isset($ADM )) {
            return response()->json([
                'status' => false,
                'message' => "ADM não encontrado"
            ]);
        }
        $ADM ->delete();

        return response()->json([
            'status' => false,
            'message' => 'ADM excluido com sucesso'
        ]);
    }


    public function pesquisarPorNome(Request $request)
    {
        $ADM =  Adm::where('nome', 'like', '%' . $request->nome . '%')->get();
        if (count($ADM) > 0) {
            return response()->json([
                'status' => true,
                'data' => $ADM
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'não há resultados para pesquisa.'
        ]);
    }


    public function update(ADMFormRequestUpdate $request)
    {
        $ADM  = Adm::find($request->id);

        if (!isset($ADM )) {
            return response()->json([
                'status' => false,
                'message' => "ADM não encontrado"
            ]);
        }

        if (isset($request->nome)) {
            $ADM ->nome = $request->nome;
        }
        if (isset($request->celular)) {
            $ADM ->celular = $request->celular;
        }
        if (isset($request->email)) {
            $ADM ->email = $request->email;
        }
        if (isset($request->cpf)) {
            $ADM ->cpf = $request->cpf;
        }
        if (isset($request->dataNascimento)) {
            $ADM ->dataNascimento = $request->dataNascimento;
        }
        if (isset($request->cidade)) {
            $ADM ->cidade = $request->cidade;
        }
        if (isset($request->estado)) {
            $ADM ->estado = $request->estado;
        }
        if (isset($request->pais)) {
            $ADM ->pais = $request->pais;
        }
        if (isset($request->rua)) {
            $ADM ->rua = $request->rua;
        }
        if (isset($request->numero)) {
            $ADM ->numero = $request->numero;
        }
        if (isset($request->bairro)) {
            $ADM->bairro = $request->bairro;
        }
        if (isset($request->cep)) {
            $ADM->cep = $request->cep;
        }
        if (isset($request->complemento)) {
            $ADM->complemento = $request->complemento;
        }
        if (isset($request->password)) {
            $ADM->password = $request->password;
        }

        $ADM->update();

        return response()->json([
            'status' => false,
            'message' => "ADM atualizado"
        ]);
    }

    public function login(Request $request)
    {
        try{
            if (Auth::guard('ADM')->attempt([
                'email' => $request->email,
                'password' => $request->password 
            ])) {
                $user = Auth::guard('ADM')->user();

                $token = $user->createToken($request->server('HTTP_USER_AGENT', ['ADM']))->plainTextToken;

                return response()->json([
                    'status' => true,
                    'message' => 'login efetuado com sucesso',
                    'token' => $token
                ]);
            } else {
                return response()->json([
                    'status'=> false,
                    'message'=> 'credenciais incorretas'
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function verificarUsuarioLogado(Request $request)
    {
        return Auth::user();
    }

} 

