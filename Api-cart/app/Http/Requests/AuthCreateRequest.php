<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthCreateRequest extends FormRequest
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
            // Nome do usuário é obrigatório e deve ser uma string
            'name' => 'required|string',
            // Email é obrigatório, deve ser uma string, um e-mail válido e único na tabela 'users'
            'email' => 'required|string|email|unique:users',
            // Senha é obrigatória, deve ser uma string, ter no mínimo 3 caracteres e ser confirmada
            'password' => 'required|string|min:3|confirmed',
        ];
    }
}
