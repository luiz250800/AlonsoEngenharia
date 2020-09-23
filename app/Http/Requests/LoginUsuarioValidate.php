<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUsuarioValidate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nmEmail' => 'required|string|email|max:50',
            'nmSenha' => 'required|string|max:18',
        ];
    }

    public function messages()
    {
        return [
            'nmEmail.required' => 'Email de usuário não preenchido',
            'nmEmail.string' => 'Email de usuário não deve ser um valor',
            'nmEmail.email' => 'Email de usuário deve ser válido',
            'nmEmail.max' => 'Email de usuário deve ter no máximo 50 caracteres',

            'nmSenha.required' => 'Senha não preenchida',
            'nmSenha.string' => 'Senha não deve ser um valor',
            'nmSenha.max' => 'Senha de usuário deve ter no máximo 18 caracteres',
        ];
    }
}
