<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

// Rotas públicas para registro e login
Route::post('/register', [AuthController::class, 'register']); // Registra um novo usuário
Route::post('/login', [AuthController::class, 'login']); // Faz login do usuário e retorna um token

// Rotas protegidas por autenticação (usando Sanctum)
Route::middleware(['auth:sanctum','api'])->group(function () {

   // Rotas para logout do usuário
   Route::post('/logout', [AuthController::class, 'logout']); // Faz logout do usuário e revoga o token

   // Rotas para gerenciamento de produtos
   Route::get('/products', [ProductController::class, 'index']); // Lista todos os produtos
   Route::post('/products', [ProductController::class, 'store']); // Cria um novo produto
   Route::get('/products/{id}', [ProductController::class, 'show']); // Exibe um produto específico
   Route::put('/products/{id}', [ProductController::class, 'update']); // Atualiza um produto existente
   Route::delete('/products/{id}', [ProductController::class, 'destroy']); // Remove um produto

   // Rotas para gerenciamento do carrinho de compras
   Route::post('/cart/add', [CartController::class, 'addToCart']); // Adiciona um item ao carrinho
   Route::post('/cart/remove', [CartController::class, 'removeFromCart']); // Remove um item do carrinho
   Route::post('/cart/checkout', [CartController::class, 'checkout']); // Finaliza a compra e limpa o carrinho

   //
   Route::get('/user/profile', [AuthController::class, 'userProfile']);//
   //
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

