<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    // Serviço de produto utilizado pelo controlador
    protected $productService;

    // Injeção de dependência do ProductService
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    // Método para exibir a lista de produtos
    public function index()
    {
        // Obtém a lista de produtos e retorna como uma coleção de ProductResource
        $products = $this->productService->listProducts();
        return ProductResource::collection($products);
    }

    // Método para criar um novo produto
    public function store(StoreProductRequest $request)
    {
        // Obtém o ID do usuário autenticado
        $user_id = Auth::id();
        // Cria um novo produto e obtém o produto criado
        $product = $this->productService->createProduct($request, $user_id);
        // Retorna o recurso do produto criado
        return new ProductResource($product);
    }

    // Método para exibir um produto específico
    public function show($id)
    {
        // Obtém o produto específico e retorna como um ProductResource
        $product = $this->productService->showProduct($id);
        return new ProductResource($product);
    }

    // Método para atualizar um produto existente
    public function update(UpdateProductRequest $request, $id)
    {
        // Atualiza o produto e obtém o produto atualizado
        $product = $this->productService->updateProduct($request, $id);
        // Retorna o recurso do produto atualizado
        return new ProductResource($product);
    }

    // Método para excluir um produto
    public function destroy($id)
    {
        // Exclui o produto
        $this->productService->deleteProduct($id);
        // Retorna uma mensagem de sucesso
        return response()->json(['message' => 'Product successfully deleted.']);
    }
}
