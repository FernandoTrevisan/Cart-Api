<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // Definindo quais atributos podem ser preenchidos em massa
    protected $fillable = [
        'user_id', // ID do usuário associado ao carrinho
        'is_checked_out', // Status indicando se o carrinho foi finalizado (checkout)
        'status' // Status atual do carrinho (ex: ativo, inativo)
    ];

    public function items()
    {
        // Relaciona o carrinho com múltiplos itens do carrinho
        return $this->hasMany(CartItem::class, 'cart_id');
    }

    public function user()
    {
        // Relaciona o carrinho a um único usuário
        return $this->belongsTo(User::class);
    }

    use HasFactory; // Habilita o uso de fábricas para criar instâncias do modelo
}
