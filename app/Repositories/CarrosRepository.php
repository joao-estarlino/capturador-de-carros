<?php

namespace App\Repositories;

use App\Models\Carros;
use Illuminate\Support\Facades\DB;

class CarrosRepository
{
    public function salvar(Carros $carros)
    {
        $carro = Carros::where('nome_veiculo', $carros->nome_veiculo)
        ->where('cor', $carros->cor)
        ->where('ano', $carros->ano)
        ->where('combustivel', $carros->combustivel)
        ->where('portas', $carros->portas)
        ->where('quilometragem', $carros->quilometragem)
        ->where('cambio', $carros->cambio)
        ->where('user_id', $carros->user_id)
        ->where('link', $carros->link)
        ->first();

        if(!$carro){
            return $carros->save();
        }

        return(true);
    }

    public function deletar(array $carros)
    {
        $carro = Carros::where('nome_veiculo', $carros['nome_veiculo'])
        ->where('cor', $carros['cor'])
        ->where('ano', $carros['ano'])
        ->where('combustivel', $carros['combustivel'])
        ->where('portas', $carros['portas'])
        ->where('quilometragem', $carros['quilometragem'])
        ->where('cambio', $carros['cambio'])
        ->where('user_id', $carros['user_id'])
        ->where('link', $carros['link'])
        ->first();

        if ($carro) {
            $carro->delete();
        }
    }
}