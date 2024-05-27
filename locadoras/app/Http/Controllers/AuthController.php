<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $credenciais = $request->all(['email', 'password']);

        $token = auth()->attempt($credenciais);

        if ($token) {
            return response()->json(['sucesso' => $token], 200);
        }

        return response()->json(['erro' => 'usuario ou senha invalido'], 403);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['msg' => 'Logout foi feito com sucesso']);
    }
    public function refresh()
    {
        $token = auth('api')->refresh();

        return response()->json(['new token' => $token]);
        
    }
}
