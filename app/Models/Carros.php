<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carros extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nome_veiculo',
        'link',
        'ano',
        'combustivel',
        'portas',
        'quilometragem',
        'cambio',
        'cor',
    ];
}
