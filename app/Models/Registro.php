<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $fillable = [
        'cpf',
        'nome',
        'sobrenome',
        'data_nascimento',
        'email',
        'genero',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
