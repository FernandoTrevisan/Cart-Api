<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // ID do carrinho
            'id' => $this->id,
            // ID do produto associado ao item do carrinho
            'product_id' => $this->product_id,
            // Quantidade do produto no carrinho
            'quantity' => $this->quantity,
            // Data e hora de criação do carrinho, formatada como string
            'created_at' => $this->created_at->toDateTimeString(),
            // Data e hora da última atualização do carrinho, formatada como string
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
