<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function register(array $data)
    {
        // Hash a senha antes de salvar o usuário no banco de dados
        $data['password'] = Hash::make($data['password']);
        return User::create($data); // Cria e retorna o usuário
    }

    public function login(array $credentials)
    {
        // Tenta autenticar o usuário com as credenciais fornecidas
        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // Obtém o usuário autenticado
            $token = $user->createToken('api_token')->plainTextToken;
            return ['token' => $token, 'user' => $user]; // Retorna o token e o usuário
        }
        // Retorna um erro se a autenticação falhar
        return ['error' => 'Unauthorized.'];
    }

    public function logout()
    {
        // Remove todos os tokens de autenticação do usuário
        Auth::user()->tokens()->delete();
        return ['message' => 'Logged out.']; // Retorna uma mensagem de sucesso
    }
}
