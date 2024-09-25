<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Permite que qualquer usuário faça essa requisição
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Nome do produto é obrigatório, deve ser uma string com no máximo 255 caracteres
            'name' => 'required|string|max:255',
            // Preço é obrigatório, deve ser um número e não pode ser negativo
            'price' => 'required|numeric|min:0',
            // Quantidade é obrigatória, deve ser um inteiro e não pode ser negativa
            'quantity' => 'required|integer|min:0',
            // Descrição é opcional, deve ser uma string se fornecida
            'description' => 'nullable|string',
        ];
    }
}
