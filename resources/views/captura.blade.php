<!DOCTYPE html>
<html>
  <head>
    <title>Tela de Capturar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
      body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 90vh;
            margin: 0;
            padding: 20px;
        }

        form {
            max-width: 300px;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        
        .btn-primary {
            background-color: #4CAF50;
            border: none;
        }
        
        .btn-primary:hover {
            background-color: #45a049;
        }

        .btn-capturar{
          margin-bottom: 10px;
        }
        
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">Tela de Capturar</div>
            <div class="card-body">
              <form method="POST" action="{{ route('carros.capturar') }}">
              @csrf
                <div class="mb-3">
                  <label for="texto">Digite informações sobre o carro:</label>
                  <input type="text" name="carros" class="form-control" id="texto" placeholder="Carro">
                </div>
                <button type="submit" class="btn btn-primary btn-capturar">Capturar</button>
                <a href="{{ route('carros.index') }}" class="btn btn-primary">Ver Carros</a>
              </form>

              @if (session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
              @endif

              @if (session('error'))
              <div class="alert alert-danger">
                  {{ session('error') }}
              </div>
              @endif

              @if (session('info'))
              <div class="alert alert-info">
                  {{ session('info') }}
              </div>
              @endif

            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
