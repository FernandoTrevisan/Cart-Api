<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            // Nome do produto é opcional para atualização, se fornecido deve ser uma string com no máximo 255 caracteres
            'name' => 'sometimes|string|max:255',
            // Preço é opcional para atualização, se fornecido deve ser um número e não pode ser negativo
            'price' => 'sometimes|numeric|min:0',
            // Quantidade é opcional para atualização, se fornecida deve ser um inteiro e não pode ser negativa
            'quantity' => 'sometimes|integer|min:0',
            // Descrição é opcional, deve ser uma string se fornecida
            'description' => 'nullable|string',
        ];
    }
}
