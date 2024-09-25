<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    // Definindo quais atributos podem ser preenchidos em massa
    protected $fillable = [
        'product_id', // ID do produto associado ao item do carrinho
        'quantity', // Quantidade do produto no carrinho
        'cart_id', // ID do carrinho ao qual o item pertence
        'user_id' // ID do usuário que possui o item no carrinho
    ];

    public function cart()
    {
        // Relaciona o item do carrinho a um único carrinho
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        // Relaciona o item do carrinho a um único produto
        return $this->belongsTo(Product::class);
    }

    use HasFactory; // Habilita o uso de fábricas para criar instâncias do modelo
}
