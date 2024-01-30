<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClienteFormrequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array 

    { 

        return [ 

            'nome'=> 'required|min:5|max:120', 

            'celular'=>'required|max:11|min:10', 

            'email'=>'unique:clientes,email|required|email|max:120', 

            'cpf'=>'unique:clientes,cpf|required|max:11|min:11', 

            'dataNascimento'=> 'required', 

            'cidade'=>'required|max:120|min:2', 

            'estado'=>'required|max:2', 

            'pais'=>'required|max:80', 

            'rua'=>'required|max:120', 

            'numero'=>'required|max:10', 

            'bairro'=>'required|max:100', 

            'cep'=>'required|max:8|min:8', 

            'complemento'=>'|max:150', 

            'senha'=>'required', 

        ]; 

    } 

    public function failedValidation(Validator $validator){ 

        throw new HttpResponseException(response()->json([ 

           'success'=>false, 

           'error'=>$validator->errors() 

        ])); 

} 

public function messages(){ 

    return [ 

        'nome.required'=>'O campo nome é obrigatório', 

        'nome.min'=>'O campo nome deve conter no mínimo 5 caracteres', 

        'nome.max'=>'O campo nome deve conter no máximo 120 caracteres', 

 

        'celular.required'=>'Celular obrigatório', 

        'celular.max'=>'Celular deve conter no máximo 11 caracteres', 

        'celular.min'=>'Celular deve conter no mínimo 10 caracteres', 

 

        'email.required'=>'E-mail obrigátorio', 

        'email.max'=>'E-mail deve conter no máximo 120 caracteres', 

 

        'cpf'=>'O campo CPF é obrigatório', 

        'cpf.max'=>'O campo cpf deve conter no máximo 11 caracteres', 

        'cpf.min'=>'O campo cpf deve conter no mínimo 11 caracteres', 

        'cpf.unique'=>'O campo cpf deve ser único', 

 

        'dataNascimento.required'=>'Data de Nascimento obrigatório', 

 

        'cidade.required'=>'Cidade obrigatório', 

        'cidade.max'=>'Cidade deve conter no máximo 120 caracteres', 

        'cidade.min'=>'Cidade deve conter no mínimo 2 caracteres', 

 

        'estado.required'=>'Estado é obrigatório', 

        'estado.max'=>'O campo estado deve conter no máximo 2 caracteres', 

 

        'pais.required'=>'país obrigatório', 

        'pais.max'=>'País deve conter no máximo 80 caracteres', 

 

        'rua.required'=>'Rua obrigátorio', 

        'rua.max'=>'rua deve conter no máximo 120 caracteres', 

         

        'numero.required'=>'Número é obrigátorio', 

        'numero.max'=>'Número deve conter no máximo 10 caracteres', 

 

        'bairro.required'=>'Bairro é obrigátorio', 

        'bairro.max'=>'Bairro deve conter no máximo 100 caracteres', 

 

        'cep.required'=>'CEP é obrigátorio', 

        'cep.max'=>'CEP deve conter no máximo 8 caracteres', 

 

        'cep.min'=>'O campo CEP deve conter no mínimo 8 caracteres', 

 

        'complemento.max'=>'Complemento deve conter no máximo 150 caracteres', 

         

        'senha.required'=>'Senha é obrigátorio' 

]; 

  

}    

} 