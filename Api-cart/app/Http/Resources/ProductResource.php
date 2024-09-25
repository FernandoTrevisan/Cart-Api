<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // ID do produto
            'id' => $this->id,
            // Nome do produto
            'name' => $this->name,
            // Preço do produto
            'price' => $this->price,
            // Quantidade disponível do produto
            'quantity' => $this->quantity,
            // Descrição do produto
            'description' => $this->description,
            // Data e hora de criação do produto, formatada como string
            'created_at' => $this->created_at->toDateTimeString(),
            // Data e hora da última atualização do produto, formatada como string
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
