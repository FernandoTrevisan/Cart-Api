<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Requests\AuthCreateRequest;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthLogoutRequest;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    // Serviço de autenticação utilizado pelo controlador
    protected $authService;

    // Injeção de dependência do AuthService
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    // Método para registrar um novo usuário
    public function register(AuthCreateRequest $request)
    {
        // Valida e obtém os dados do request
        $validatedData = $request->validated();
        try {
            // Registra o usuário e obtém o usuário criado
            $user = $this->authService->register($validatedData);
            // Retorna o recurso do usuário registrado
            return new UserResource($user);
        } catch (\Exception $e) {
            // Retorna uma resposta de erro caso ocorra uma exceção
            return response()->json(['error' => 'Error registering user.'], 422);
        }
    }

    // Método para obter o perfil do usuário autenticado
    public function userProfile()
    {
        // Obtém o usuário autenticado
        $user = Auth::user();
        // Retorna o recurso do usuário
        return new UserResource($user);
    }

    // Método para realizar o login do usuário
    public function login(AuthLoginRequest $request)
    {
        // Valida e obtém as credenciais do request
        $credentials = $request->validated();
        // Realiza o login e obtém os dados de login
        $loginData = $this->authService->login($credentials);
        if (isset($loginData['error'])) {
            // Retorna uma resposta de erro caso as credenciais estejam inválidas
            return response()->json($loginData, 401);
        }
        // Retorna a resposta com os dados de login, incluindo o token e o usuário
        return response()->json($loginData);
    }

    // Método para realizar o logout do usuário
    public function logout(AuthLogoutRequest $request)
    {
        // Realiza o logout
        $this->authService->logout();
        // Retorna uma mensagem de sucesso
        return response()->json(['message' => 'Logged out.'], 200);
    }

}
