<!DOCTYPE html>
<html>
  <head>
    <title>Tela de Capturar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
      body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            display: block;
            align-items: center;
            justify-content: center;
            height: 90vh;
            margin: 0;
            padding: 20px;
        }
        
        .form-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-sizing: border-box;
        }
        
        .btn {
	        width: 100%;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

    </style>
  </head>
  <body>
    <div class="container">
        <h1>Lista de Carros</h1>
        @if ($carros->isEmpty())
            <p>Ainda não há carros salvos aqui.</p>
        @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Link</th>
                    <th>Ano</th>
                    <th>Combustível</th>
                    <th>Portas</th>
                    <th>Quilometragem</th>
                    <th>Câmbio</th>
                    <th>Cor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carros as $carro)
                <tr>
                    <td>{{ $carro->nome_veiculo }}</td>
                    <td>{{ $carro->link }}</td>
                    <td>{{ $carro->ano }}</td>
                    <td>{{ $carro->combustivel }}</td>
                    <td>{{ $carro->portas }}</td>
                    <td>{{ $carro->quilometragem }}</td>
                    <td>{{ $carro->cambio }}</td>
                    <td>{{ $carro->cor }}</td>
                    <td>
                    <form action="{{ route('carros.destroy', $carro->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Excluir</button>
                    </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
