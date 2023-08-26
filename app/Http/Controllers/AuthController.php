<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validação dos campos do formulário de registro
        
        $usuario = Usuario::create([
            'usuario' => $request->usuario,
            'senha' => Hash::make($request->senha),
        ]);
        
        // Login do usuário após o registro
        
        // Redirecionar para a página de perfil ou painel de controle
    }

    public function login(Request $request)
    {
        $credentials = $request->only('usuario', 'senha');

        if (Auth::attempt($credentials)) {
            // Login bem-sucedido
            
            // Redirecionar para a página de perfil ou painel de controle
        } else {
            // Login falhou
        }
    }

    public function logout()
    {
        Auth::logout();
        
        // Redirecionar para a página inicial ou página de login
    }
}