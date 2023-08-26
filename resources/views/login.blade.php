<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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

        h1 {
            text-align: center;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
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
            background-color: #4CAF50; /* Green */
            border: none;
        }
        
        .btn-primary:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div>
        <h1>Login</h1>
        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <div class="mb-3">
                <input type="text" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Senha" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>

        @if($errors->any())
            <div class="error-message">{{ $errors->first('message') }}</div>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
