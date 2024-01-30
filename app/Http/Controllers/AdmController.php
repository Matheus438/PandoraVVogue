<?php

namespace App\Http\Controllers;

use App\Http\Requests\ADMFormRequest;
use App\Models\ADM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdmController extends Controller
{
    public function store(ADMFormRequest $request) 

    { 

        $ADM = ADM::create([ 

            'nome' => $request->nome, 

            'celular' => $request->celular, 

            'email' => $request->email, 

            'cpf' => $request->cpf, 

            'dataNascimento' => $request->dataNascimento, 

            'cidade' => $request->cidade, 

            'estado' => $request->estado, 

            'pais' => $request->pais, 

            'rua' => $request->rua, 

            'numero' => $request->numero, 

            'bairro' => $request->bairro, 

            'cep' => $request->cep, 

            'complemento' => $request->complemento, 

            'senha' => Hash::make($request->senha) 

        ]); 

 

        return response()->json([ 

            "success" => true, 

            "message" => "ADM Cadrastado com sucesso", 

            "data" => $ADM 

 

        ], 200); 

    } 

    public function redefinirSenha(Request $request) 

    { 

        $ADM = ADM::where('email', $request->email)->first(); 

         

        if (!isset($ADM)) { 

            return response()->json([ 

                'status' => false, 

                'message' => "ADM não encontrado!" 

            ]); 

        } 

 

        $ADM->password = Hash::make($ADM->cpf); 

        $ADM->update();     

 

        return response()->json([ 

            'status' => false, 

            'message' => "Sua senha foi atualizada" 

        ]); 

    } 

} 

