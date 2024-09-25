<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // ID do item do carrinho
            'id' => $this->id,
            // ID do produto associado ao item do carrinho
            'product_id' => $this->product_id,
            // Quantidade do produto no carrinho
            'quantity' => $this->quantity,
            // Detalhes do produto, carregado apenas se a relação 'product' estiver carregada
            'product' => new ProductResource($this->whenLoaded('product')),
        ];
    }
}
