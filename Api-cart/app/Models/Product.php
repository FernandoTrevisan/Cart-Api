<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Definindo quais atributos podem ser preenchidos em massa
    protected $fillable = [
        'name', // Nome do produto
        'price', // Preço do produto
        'quantity', // Quantidade disponível do produto
        'description', // Descrição do produto
        'user_id', // ID do usuário que criou ou gerencia o produto
    ];

    use HasFactory; // Habilita o uso de fábricas para criar instâncias do modelo
}
