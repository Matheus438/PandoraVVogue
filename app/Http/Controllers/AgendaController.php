<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgendaFormRequest;
use App\Http\Requests\AgendaFormRequestUpdate;
use App\Http\Requests\AgendaUpdateFormRequest;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function criarAgenda(AgendaFormRequest $request)
    {
        $agenda = Agenda::create([
            'cliente_Id' => $request->cliente_Id,
            'profissional_Id' => $request->profissional_Id,
            'data_Hora' => $request->data_Hora,
            'servico_Id' => $request->servico_Id,
            'pagamento' => $request->pagamento,
            'valor' => $request->valor
        ]);

        return response()->json([
            "success" => true,
            "message" => "agenda cadastrado",
            "data" => $agenda
        ], 200);
    }

    public function criarHorarioProfissional(AgendaFormRequest $request)
    {

        $agenda = Agenda::where('data_Hora', '=', $request->data_Hora)->where('profissional_Id', '=', $request->profissional_Id)->get();

        if (count($agenda) > 0) {
            return response()->json([
                "status" => false,
                "message" => "Horario já cadastrado",
                "data" => $agenda
            ], 200);    
        } else {

            $agenda = Agenda::create([
                'profissional_Id' => $request->profissional_Id,
                'data_Hora' => $request->data_Hora
            ]);
            return response()->json([
                "status" => true,
                "message" => "Agendado com sucesso",
                "data" => $agenda
            ], 200);
        }
    }
    public function pesquisarPorDataDoProfissional(Request $request){
        if ($request->profissional_Id == 0 || $request->profissional_Id ==''){
            $agenda = Agenda::all();
        } else {
            $agenda = Agenda::where('profissional_Id', $request->profissional_Id);
            if(isset($request->data_Hora)) {
                $agenda->whereDate('data_Hora', '=', $request->data_Hora);
            }
            $agenda = $agenda-> get();
        }
        if(count($agenda) > 0) {
            return response()->json([
                'status' => true,
                'data' => $agenda
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Sem resultados para sua pesquisa.'
        ]);
    }
    public function excluiAgenda($id)
    {
        
        $agenda = Agenda::find($id);
        if (!isset($agenda)) {
            return response()->json([
                'status' => false,
                'message' => " não encontrado"
            ]);
        }

        $agenda->delete();
        return response()->json([
            'status' => true,
            'message' => " excluído com sucesso"
        ]);
    }
    public function updateAgenda(AgendaFormRequestUpdate $request)
    {
        $agenda = Agenda::find($request->id);

        if (!isset($agenda)) {
            return response()->json([
                'status' => false,
                'message' => "agenda não encontrado"
            ]);
        }
       
        if(isset($request->clienteId)){
        $agenda-> clienteId = $request->clienteId;
        }
        if(isset($request->profissionalId)){
        $agenda-> profissionalId = $request->profissionalId;
        }
        if(isset($request->dataHora)){
        $agenda-> dataHora = $request->dataHora;
        }
        if(isset($request->servicoId)){
        $agenda-> servicoId = $request->servicoId;
        }
        if(isset($request->pagamento)){
            $agenda-> pagamento = $request->pagamento;
        }
        if(isset($request->valor)){
            $agenda-> valor = $request->valor;
        }

        $agenda->update();

        return response()->json([
            'status' => true,
            'message' => " atualizado."
        ]);
       
    }
    public function retornarTudo(){
        $agenda = Agenda::all();

        if(count($agenda)==0){
            return response()->json([
                'status'=> false,
                'message'=> " nao encontrado"
            ]);
        }
        return response()->json([
            'status'=> true,
            'data' => $agenda
        ]);
       }
}
