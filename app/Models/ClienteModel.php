<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'celular',
        'email',
        'cpf',
        'nascimento',
        'cidade',
        'estado',
        'pais',
        'rua',
        'numero',
        'bairro',
        'cep',
        'complemento',
        'password',
    ];
}
