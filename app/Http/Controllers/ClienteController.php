<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteFormrequest;
use App\Models\ClienteModel;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function CadastrarClientes(ClienteFormrequest $request)
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
}
