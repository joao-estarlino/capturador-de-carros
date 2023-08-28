<?php

namespace App\Repositories;

use App\Models\Carros;
use Illuminate\Support\Facades\DB;

class CarrosRepository
{
    /**
     * Retorna todos os carros.
     *
     * @return \Illuminate\Database\Eloquent\Collection|Carros[]
     */
    public function getAll()
    {
        return Carros::all();
    }

    /**
     * Salva um objeto Carros, se ele não existir.
     *
     * @param Carros
     * @return bool
     */
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

    /**
     * Deleta um carro, se ele existir.
     *
     * @param array
     * @return void
     */
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

    /**
     * Exclui um carro do banco de dados.
     *
     * @param Carros
     * @return void
     */
    public function destroy(Carros $carro)
    {
        $carro->delete();
    }
}