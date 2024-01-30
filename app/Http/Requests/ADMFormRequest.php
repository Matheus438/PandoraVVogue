<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ADMFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nome' => 'required|max:120|min:5',
            'email' => 'required|email|unique:cliente_models,email',
            'cpf' => 'required|max:11|min:11|unique:cliente_models,cpf',
            'password' => 'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()
        ]));
    }
    public function messages(){

        return[
            'nome.required' => 'o nome é obrigatorio',
            'nome.max' => 'o campo nome deve contar no maximo 120 caracteres',
            'nome.min' => 'o campo nome deve contar no minimo 5 caracteres',

           
            'email.required' => 'o email é obrigatorio',
            'email.email' => 'formato de email invalido',
            'email.unique' => 'email ja cadastrado no sistema',

            'cpf.required' => 'o cpf é obrigatorio',
            'cpf.max' => 'o campo cpf deve contar no maximo 11 caracteres',
            'cpf.min' => 'o campo cpf deve contar no minimo 11 caracteres',
            'cpf.unique' => 'cpf ja cadastrado no sistema',
    
            'password.required' => 'a senha obrigatorio'
        ];
    }
}
        