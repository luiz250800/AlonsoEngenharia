<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastroUsuarioValidate extends FormRequest
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
            'nmUsuario' => 'required|string|max:50',
            'nmEmail' => 'required|string|email|max:50|unique:tb_usuario,nm_email_usuario',
            'nmSenha' => 'required|string|min:6|max:18|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'nmUsuario.required' => 'Nome de usuário não preenchido',
            'nmUsuario.string' => 'Nome não deve ser um valor',
            'nmUsuario.max' => 'Nome deve ter no máximo 50 caracteres',

            'nmEmail.required' => 'Email de usuário não preenchido',
            'nmEmail.string' => 'Email de usuário não deve ser um valor',
            'nmEmail.email' => 'Email de usuário deve ser válido',
            'nmEmail.max' => 'Email de usuário deve ter no máximo 50 caracteres',
            'nmEmail.unique' => 'Email de usuário já cadastrado',

            'nmSenha.required' => 'Senha não preenchida',
            'nmSenha.string' => 'Senha não deve ser um valor',
            'nmSenha.min' => 'Senha deve ter no mínimo 6 caracteres',
            'nmSenha.max' => 'Senha deve ter no máximo 18 caracteres',
            'nmSenha.confirmed' => 'Senha e confirmação de senha não conferem',
        ];
    }
}
