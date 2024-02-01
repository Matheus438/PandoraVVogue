<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AgendaFormRequestUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|string>
     */
    public function rules(): array
    {
        return [
            'profissional_id' => 'integer',
            'cliente_id' => 'integer',
            'servico_id' => 'integer',
            'data_Hora' => '|date',
            'pagamento' => '|max:20|min:3',
            'valor' => '|decimal: 2,4',
        ];
    }
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()
        ]));
    }
    public function messages()
    {
        return[
        'profissional_Id.required' => 'Campo profissional é obrigatório',
        'cliente_Id.required' => 'Campo cliente é obrigatório',
        'servico_Id.required' => 'Campo serviço é obrigatório',
        'data_Hora.required' => 'Campo data é obrigatório',
        'data_Hora.date' => 'Formato Inválido',
        'pagamento.required' => 'Campo pagamento é obrigatório',
        'pagamento.max' => 'Campo pagamento deve conter no maximo 20 caracteres',
        'pagamento.min' => 'Campo pagamento deve conter no minimo 3 caracteres',
        'valor.required' => 'Campo valor é obrigatório',
        'valor.decimal' => 'Este campo so aceita numero decimal'
        ];

}
}