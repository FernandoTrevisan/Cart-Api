<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\RemoveFromCartRequest;
use App\Http\Requests\CheckoutRequest;
use App\Http\Resources\CartResource;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // Serviço de carrinho utilizado pelo controlador
    protected $cartService;

    // Injeção de dependência do CartService
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    // Método para adicionar um item ao carrinho
    public function addToCart(AddToCartRequest $request)
    {
        // Obtém o ID do usuário autenticado
        $user_id = Auth::id();
        // Valida e obtém os dados do request
        $validatedData = $request->validated();
        try {
            // Adiciona o item ao carrinho e obtém o item adicionado
            $cartItem = $this->cartService->addToCart($validatedData['product_id'], $validatedData['quantity'], $user_id);
            // Retorna o recurso do item do carrinho
            return new CartResource($cartItem);
        } catch (\Exception $e) {
            // Retorna uma resposta de erro caso ocorra uma exceção
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    // Método para remover um item do carrinho
    public function removeFromCart(RemoveFromCartRequest $request)
    {
        // Obtém o ID do usuário autenticado
        $user_id = Auth::id();
        // Valida e obtém os dados do request
        $validatedData = $request->validated();
        if (!isset($validatedData['product_id'])) {
            return response()->json(['message' => 'Product ID is required.'], 400);
        }
        try {
            // Remove o item do carrinho, passando a quantidade, se fornecida
            $this->cartService->removeFromCart(
                $validatedData['product_id'],
                $user_id,
                $validatedData['quantity'] ?? null // Passa a quantidade, se existir, ou null
            );
            return response()->json(['message' => 'Product removed from cart.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    // Método para realizar o checkout do carrinho
    public function checkout(CheckoutRequest $request)
    {
        // Obtém o ID do usuário autenticado
        $user_id = Auth::id();
        // Realiza o checkout do carrinho e obtém o resultado
        $result = $this->cartService->checkout($user_id);

        if (isset($result['error'])) {
            // Retorna uma resposta de erro caso ocorra um problema durante o checkout
            return response()->json(['error' => $result['error']], 404);
        }
        // Retorna uma mensagem de sucesso, sem incluir ''
        return response()->json(['message' => $result['message']], 200);
    }
}
