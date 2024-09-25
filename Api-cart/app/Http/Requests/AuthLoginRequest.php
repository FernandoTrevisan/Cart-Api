<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthLoginRequest extends FormRequest
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
            // Email é obrigatório, deve ser uma string e um e-mail válido
            'email' => 'required|string|email',
            // Senha é obrigatória e deve ser uma string
            'password' => 'required|string',
        ];
    }
}
