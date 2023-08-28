<?php

namespace App\Http\Controllers;

use App\Models\Carros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Repositories\CarrosRepository;

class CarrosController extends Controller
{
    protected $carrosRepository;
    
    public function __construct(CarrosRepository $carrosRepository)
    {
        $this->carrosRepository = $carrosRepository;
    }
    
    public function capturarCarros(Request $request)
    {
        $url = 'https://www.questmultimarcas.com.br/estoque?termo='.$request->carros;

        $links = $this->capturarLinks($url);

        foreach($links as $link){
            $carros[] = $this->capturarDadosDoVeiculo($link);
        }

        if(!$this->salvarCarros($carros)){
            return redirect()->back()->with(['error' => 'Não foi possível salvar os veículos']);
        }

        return redirect()->back()->with(['success' => 'Veículos salvos com sucesso']);

    }

    private function salvarCarros(array $carros)
    {
        foreach ($carros as $carroData) {
            $carro = new Carros($carroData);
            if(!$this->carrosRepository->salvar($carro)){
                $this->deletarCarros($carros);
                return false;
            } 
        }
       return true;
    }

    private function deletarCarros(array $carros)
    {
        foreach ($carros as $carro) {
            $this->carrosRepository->deletar($carro);
        }
    }

    private function capturarLinks(string $url){

        $response = Http::get($url);

        $html = $response->body();

        $pattern = '/<div class="card card-car">\s*<a\s+href="([^"]+)"\s+title="[^"]+"/';
        preg_match_all($pattern, $html, $matches);

        return $matches[1];
    }

    private function capturarDadosDoVeiculo(string $link){

        $response = Http::get($link);

        $html = $response->body();

        $pattern = '/<title>.*?(Flex|Gasolina|Diesel|Elétrico|Gasolina e Elétrico).*?(\d+)\s*portas.*?câmbio\s*(Manual|Automático)/';

        preg_match_all($pattern, $html, $matches);

        $carro['user_id'] = Auth::id();;
        $carro['combustivel'] = $matches[1][0];
        $carro['portas'] = $matches[2][0];
        $carro['cambio'] = $matches[3][0];
        $carro['link'] = $link;

        $pattern = '/<\/figure>\s*<p>\s*(Azul|Branco|Cinza|Marrom|Prata|Preto|Verde|Vermelho|Várias cores)/';

        preg_match_all($pattern, $html, $matches);

        $carro['cor'] = $matches[1][0];

        $pattern =  '/<\/figure>\s*<p>\s*(\d+(\.\d+)?)\s*km/';

        preg_match_all($pattern, $html, $matches);

        $carro['quilometragem'] = $matches[1][0];

        $pattern = '/<\/figure>\s+<p>\s+(\d{4}\/\d{4})\s+<\/p>/';

        preg_match_all($pattern, $html, $matches);

        $carro['ano'] = $matches[1][0];

        $pattern = '/<div class="title">\s+<h2><span class="fw-normal">(.*?)<\/span> (.*?)<\/h2>/';

        preg_match_all($pattern, $html, $matches);

        $carro['nome_veiculo'] = $matches[1][0]." ".$matches[2][0];

        return $carro;
    }
}
