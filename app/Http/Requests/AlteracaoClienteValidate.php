<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlteracaoClienteValidate extends FormRequest
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
            'nmRazaoSocial' => 'required|string|max:50',
            'nmFantasia' => 'required|string|max:60',
            'cdCnpj' => 'required|numeric|digits:15',
            'nmEndereco' => 'required|string|max:80',
            'nmEmail' => 'required|string|email|max:50',
            'cdTelefone' => 'required|numeric|digits:10',
            'nmResponsavel' => 'required|string|max:50',
            'cdCpfResponsavel' => 'required|numeric|digits:11',
            'cdCelularResponsavel' => 'required|numeric|digits:11',
        ];
    }

    public function messages()
    {
        return [
            'nmRazaoSocial.required' => 'Razão social não preenchida',
            'nmRazaoSocial.string' => 'Razão social não deve ser um valor',
            'nmRazaoSocial.max' => 'Razão social deve ter no máximo 50 caracteres',

            'nmFantasia.required' => 'Nome fantasia não preenchido',
            'nmFantasia.string' => 'Nome fantasia não deve ser um valor',
            'nmFantasia.max' => 'Nome fantasia deve ter no máximo 50 caracteres',

            'cdCnpj.required' => 'CNPJ não preenchido',
            'cdCnpj.numeric' => 'CNPJ deve conter apenas números',
            'cdCnpj.digits' => 'CNPJ deve ter 15 caracteres',

            'nmEndereco.required' => 'Endereço não preenchido',
            'nmEndereco.string' => 'Endereço não deve ser um valor',
            'nmEndereco.max' => 'Endereço deve ter no máximo 80 caracteres',

            'nmEmail.required' => 'Email não preenchido',
            'nmEmail.string' => 'Email não deve ser um valor',
            'nmEmail.email' => 'Email deve ser válido',
            'nmEmail.max' => 'Email deve ter no máximo 50 caracteres',

            'cdTelefone.required' => 'Telefone não preenchido',
            'cdTelefone.numeric' => 'Telefone deve conter apenas números',
            'cdTelefone.digits' => 'Telefone deve ter 10 caracteres',

            'nmResponsavel.required' => 'Nome do responsável não preenchido',
            'nmResponsavel.string' => 'Nome do responsável não deve ser um valor',
            'nmResponsavel.max' => 'Nome do responsável deve ter no máximo 50 caracteres',

            'cdCpfResponsavel.required' => 'CPF do responsável não preenchido',
            'cdCpfResponsavel.numeric' => 'CPF do responsável deve conter apenas números',
            'cdCpfResponsavel.digits' => 'CPF do responsável deve ter 11 caracteres',

            'cdCelularResponsavel.required' => 'Celular do responsável não preenchido',
            'cdCelularResponsavel.numeric' => 'Celular do responsável deve conter apenas números',
            'cdCelularResponsavel.digits' => 'Celular do responsável deve ter 11 caracteres',
        ];
    }
}
