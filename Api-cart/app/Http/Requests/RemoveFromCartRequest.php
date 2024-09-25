<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RemoveFromCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
       // Permite a requisição apenas se o usuário estiver autenticado
       return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // ID do produto é obrigatório, deve ser um inteiro e existir na tabela 'products'
            'product_id' => 'required|integer|exists:products,id',
            // Quantidade é opcional, mas deve ser um número inteiro válido
            'quantity' => 'nullable|integer|min:1'
        ];
    }
}
