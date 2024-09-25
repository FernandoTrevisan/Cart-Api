<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Verifica se o usuário está autenticado antes de permitir a requisição
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
            // ID do produto deve ser um inteiro existente na tabela 'products'
            'product_id' => 'required|integer|exists:products,id',
            // Quantidade deve ser um inteiro e pelo menos 1
            'quantity' => 'required|integer|min:1',
            // ID do usuário deve ser um inteiro existente na tabela 'users'
            'user_id' => 'required|integer|exists:users,id',
        ];
    }

    protected function prepareForValidation()
    {
        // Se o usuário estiver autenticado, adiciona o ID do usuário à requisição
        if ($this->user()) {
            $this->merge([
                'user_id' => $this->user()->id,
            ]);
        }
    }

}
