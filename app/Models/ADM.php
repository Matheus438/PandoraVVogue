<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Adm extends Authenticatable
{

    use HasFactory;
    use HasApiTokens;
    use Notifiable;

    protected $fillable =[
        'nome',
        'email',
        'cpf',
        'password'
    ];
}
