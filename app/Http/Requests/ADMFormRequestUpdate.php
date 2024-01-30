<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ADMFormRequestUpdate extends FormRequest
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

            'nome' => 'required|max:80|min:5|unique:servicos,nome,'. $this->id, 

            'descricao' => 'required|max:200|min:10', 

            'duracao' => 'required|numeric', 

            'preco' => 'required|decimal:2', 

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

            'nome.required' => 'O campo nome é obrigatorio', 

            'nome.max' => 'O campo nome deve ter no maximo 80 caracteres', 

            'nome.min' => 'O campo nome deve ter no minimo 5 caracteres', 

            'nome.unique' => 'nome já cadastrado no sistema', 

            'descricao.required' => 'O campo descricao é obrigatorio', 

            'descricao.max' => 'O campo descricao deve ter no maximo 200 caracteres', 

            'descricao.min' => 'O campo descricao deve ter no minimo 10 caracteres', 

            'duracao.required' => 'O campo duracao é obrigatorio', 

            'duracao.numeric' => 'O campo duração deve ter apenas numeros', 

            'preco.required' => 'O campo preco é obrigatorio', 

            'preco.decimal' => 'O campo preco deve ter apenas numeros', 

        ]; 

    } 

} 