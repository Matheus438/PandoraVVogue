<?php

namespace App\Http\Requests;

use Dotenv\Validator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProfissionalFormRequestUpdate extends FormRequest
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
            'nome' => '|max:120|min:5',
            'celular' => '|max:11|min:10',
            'email' => '|email|max:120|',
            'cpf' => '|max:11|min:11',
            'nascimento' =>'|date',
            'cidade' => '|max:120',
            'estado' => '|max:2',
            'rua' => '|max:120',
            'numero' => '|max:10',
            'bairro' => '|max:100',
            'cep' => '|max:8|min:8',
            'complemento' => 'max:150',
            'password' => '',
            'salario' => '|decimal:2,4',
        ];
    }
    public function failedValidation(ValidationValidator $validator){
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()
        ]));
    }
    public function messages()
    {
        return [

            
            'nome.max' => 'o campo nome deve conter no maximo 80 caracteres',
            'nome.min' => 'o campo nome deve conter no minimo 5 caracteres',
           
            'celular.max' => 'o campo celular deve conter no maximo 11 caracteres',
            'celular.min' => 'o campo celular deve conter no minimo 10 caracteres',
            'email.unique' => 'o email ja foi cadastrado',
            'email.email' => 'email invalido',
            'email.max' => 'o campo email deve conter no maximo 120 caracteres',
            'cpf.unique' => 'esse cpf ja foi cadastrado',
           
            'cpf.max' => 'o campo cpf deve conter no maximo 11 caracteres',
            'cpf.min' => 'o campo cpf deve conter no minimo 11 caracteres',
            
            'cidade.max' => 'deve conter no maximo 120 caracteres',
            
            'estado.max' => 'deve conter no maximo 2 caracteres',
           
            'rua.max' => 'deve conter no maximo 120 caracteres',
           
            'numero.max' => 'deve conter no maximo 10 caracteres',
           
            'bairro.max' => 'deve conter no maximo 100 caracteres',
            
            'cep.max' => 'deve conter no maximo 8 caracteres',
            'cep.min' => 'o campo cpf deve conter no minimo 8 caracteres',
            'complemento.max' => 'deve conter no maximo 150 caracteres',
            
            
            'pais.max' => 'o campo país deve conter no maximo 80 caracteres',
           
            'salario.decimal' => 'Este campo so aceita numero decimal'

        ];
    }
}

