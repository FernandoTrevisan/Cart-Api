<?php

namespace App\Services;

use App\Models\Product;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


class ProductService
{
    public function listProducts()
    {
        return Product::all(); // Retorna todos os produtos cadastrados
    }

    public function createProduct(Request $request, $user_id)
    {
        // Valida os dados da requisição
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        $validated['user_id'] = $user_id; // Adiciona o ID do usuário ao produto

        return Product::create($validated); // Cria e retorna o novo produto
    }

    public function showProduct($id)
    {
        $product = Product::find($id); // Encontra o produto pelo ID

        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404); // Retorna erro se o produto não for encontrado
        }

        return $product; // Retorna o produto encontrado
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id); // Encontra o produto ou lança uma exceção se não encontrado

        if ($product->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.'); // Retorna erro se o usuário não estiver autorizado
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric|min:0',
            'quantity' => 'sometimes|integer|min:0',
            'description' => 'nullable|string',
        ]);

        $product->update($validated); // Atualiza o produto com os dados validados

        return $product; // Retorna o produto atualizado
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id); // Encontra o produto ou lança uma exceção se não encontrado

        if ($product->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.'); // Retorna erro se o usuário não estiver autorizado
        }

        $product->delete(); // Remove o produto

        return $product; // Retorna o produto removido
    }
}
