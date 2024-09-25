<?php

namespace App\Services;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartService
{
    public function addToCart($productId, $quantity, $user_id)
    {
        DB::beginTransaction(); // Inicia uma transação para garantir a atomicidade das operações
        try {
            $product = Product::findOrFail($productId); // Encontra o produto ou lança uma exceção se não encontrado

            // Verifica se há estoque suficiente
            if ($product->quantity < $quantity) {
                throw new \Exception("Insufficient stock. Available: {$product->quantity}, requested: {$quantity}");
            }

                // Garantir que o carrinho seja criado com o status "active"
                $cart = Cart::firstOrCreate(
                    ['user_id' => $user_id, 'status' => 'active'],
                    ['status' => 'active']
                );

                // Verifica se o produto já está no carrinho
                $cartItem = $cart->items()->where('product_id', $productId)->first();

            if ($cartItem) {
                // Atualiza a quantidade se o item já estiver no carrinho
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                // Cria um novo item no carrinho
                $cartItem = $cart->items()->create([
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'user_id' => $user_id
                ]);
            }

            // Atualiza a quantidade do produto no estoque
            $product->quantity -= $quantity;
            $product->save();

            DB::commit(); // Confirma a transação
            return $cartItem;
        } catch (\Exception $e) {
            DB::rollBack(); // Reverte a transação em caso de erro
            throw $e; // Lança a exceção novamente para ser tratada em outro lugar
        }

    }

    public function removeFromCart($product_id, $user_id, $quantity = null)
    {
        \Log::info('Removing from cart.', ['product_id' => $product_id, 'user_id' => $user_id, 'quantity' => $quantity]);

        $cartItem = CartItem::where('product_id', $product_id)
            ->where('user_id', $user_id)
            ->first();
        if (!$cartItem) {
            throw new \Exception('Cart item not found.');
        }
            $product = Product::findOrFail($product_id);
            // Se uma quantidade foi passada, vamos tentar remover essa quantidade
        if ($quantity !== null) {

            if ($cartItem->quantity > $quantity) {
                // Reduz a quantidade do item no carrinho
                $cartItem->quantity -= $quantity;
                $cartItem->save();
                // Reverte a quantidade no estoque do produto
                $product->quantity += $quantity;
                $product->save();
            } else {
                // Se a quantidade no carrinho for menor ou igual, remove o item completamente
                $product->quantity += $cartItem->quantity; // Reverte a quantidade total no estoque
                $product->save();
                $cartItem->delete(); // Remove o item do carrinho
            }
        } else {
            // Se a quantidade não foi passada, remove o item completamente
            $product->quantity += $cartItem->quantity; // Reverte a quantidade total no estoque
            $product->save();
            $cartItem->delete(); // Remove o item do carrinho
        }
    }

    public function checkout($user_id)
    {
        DB::beginTransaction(); // Inicia uma transação para garantir a atomicidade das operações
        try {
            // Encontra o carrinho ativo do usuário
            $currentCart = Cart::where('user_id', $user_id)
            ->where('status', 'active')
            ->where('is_checked_out', false)
            ->first();

            if (!$currentCart) {
                DB::rollBack(); // Reverte a transação se não houver carrinho ativo
                return [
                    'message' => null,
                    'error' => 'No active cart found for this user.',
                ];
            }

                // Verifica se o carrinho está vazio
                $cartItems = CartItem::where('cart_id', $currentCart->id)->get();

            if ($cartItems->isEmpty()) {
                DB::rollBack(); // Reverte a transação se o carrinho estiver vazio
                return [
                    'message' => null,
                    'error' => 'Cannot checkout with an empty cart.',
                ];
            }

            // Limpa todos os itens do carrinho atual
            CartItem::where('cart_id', $currentCart->id)->delete();

            // Atualiza o status do carrinho para 'completed' e marca como finalizado
            $currentCart->status = 'completed';
            $currentCart->is_checked_out = true;
            $currentCart->save();

            DB::commit();// Confirma a transação
            return [
                'message' => 'Checkout completed',
                'error' => null,
            ];
        } catch (\Exception $e) {
            DB::rollBack(); // Reverte a transação em caso de erro
            return [
                'message' => null,
                'error' => $e->getMessage(),
            ];
        }
    }
}
