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

    /**
     * Carrega a página inicial da listagem de carros.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $carros = $this->carrosRepository->getAll();
        
        return view('carros', compact('carros'));
    }

    /**
     * Remove um carro do sistema.
     *
     * @param  \App\Carros
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Carros $carro)
    {
        $this->carrosRepository->destroy($carro);
        
        return redirect()->route('carros.index');
    }

    /**
     * Captura carros com base na requisição.
     *
     * @param Request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function capturarCarros(Request $request)
    {
        $url = 'https://www.questmultimarcas.com.br/estoque?termo='.$request->carros;

        $links = $this->capturarLinks($url);

        if (empty($links)) {
            return redirect()->back()->with(['info' => 'Nenhum veículo encontrado com esse nome']);
        }

        foreach($links as $link){
            $carros[] = $this->capturarDadosDoVeiculo($link);
        }

        if(!$this->salvarCarros($carros)){
            return redirect()->back()->with(['error' => 'Não foi possível salvar os veículos']);
        }

        return redirect()->back()->with(['success' => 'Veículos salvos com sucesso']);

    }

    /**
     * Salva uma lista de carros.
     *
     * @param array $carros
     * @return bool
     */
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

    /**
     * Deleta carros fornecidos, utilizada para deletar
     * carros salvos durante uma requisição com falhas.
     *
     * @param array $carros
     * @return void
     */
    private function deletarCarros(array $carros)
    {
        foreach ($carros as $carro) {
            $this->carrosRepository->deletar($carro);
        }
    }
    
    /**
     * Captura os links de uma URL especificada.
     *
     * @param string $url
     * @return array
     */
    private function capturarLinks(string $url){

        $response = Http::get($url);
        $html = $response->body();

        $pattern = '/<div class="card card-car">\s*<a\s+href="([^"]+)"\s+title="[^"]+"/';
        preg_match_all($pattern, $html, $matches);

        return $matches[1];
    }

    /**
     * Captura os dados de um veículo a partir de um link fornecido.
     *
     * @param string $link
     * @return array
     */
    private function capturarDadosDoVeiculo(string $link){

        $response = Http::get($link);
        $html = $response->body();

        $pattern = '/<title>.*?(Flex|Gasolina|Diesel|Elétrico|Gasolina e Elétrico).*?(\d+)\s*portas.*?câmbio\s*(Manual|Automático)/';
        preg_match_all($pattern, $html, $matches);

        $carro = [];
        $carro['user_id'] = Auth::id();
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
