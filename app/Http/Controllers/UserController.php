<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/captura');
        }

        return back()->withErrors(['message' => 'Credenciais inválidas.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
