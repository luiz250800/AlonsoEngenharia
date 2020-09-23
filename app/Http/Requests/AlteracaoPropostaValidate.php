<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlteracaoPropostaValidate extends FormRequest
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
            'cdCliente' => 'required|numeric',
            'nmEndereco' => 'required|string|max:80',
            'vlTotal' => 'required|not_regex:/^[1-9][0-9]*$/',
            'vlSinal' => 'required|not_regex:/^[1-9][0-9]*$/',
            'vlParcela' => 'required|not_regex:/^[1-9][0-9]*$/',
            'qtParcela' => 'required|numeric|digits_between:1,3',
            'dtInicioPagamento' => 'required|date|after:tomorrow',
            'dtParcela' => 'required|date|after:tomorrow',
            'anexoArquivo' => 'mimes:pdf,docx,doc',
            'cdStatusProposta' => 'required|string|size:1',
        ];
    }

    public function messages()
    {
        return [
            'cdCliente.required' => 'Selecione um cliente',
            'cdCliente.numeric' => 'Código do cliente deve ser um número',

            'qtParcela.required' => 'Quantidade de parcelas não preenchida',
            'qtParcela.numeric' => 'Quantidade de parcelas deve conter apenas numeros',
            'qtParcela.digits_between' => 'Quantidade de parcelas deve ter no mínimo 1 digito e no máximo 3',

            'vlTotal.required' => 'Valor total não preenchido',
            'vlTotal.not_regex' => 'Valor total deve possuir 2 ou mais casas decimais',

            'vlSinal.required' => 'Valor do sinal não preenchido',
            'vlSinal.not_regex' => 'Valor do sinal de deve possuir 2 ou mais casas decimais',

            'vlParcela.required' => 'Valor das parcelas não preenchido',
            'vlParcela.not_regex' => 'Valor das parcelas deve possuir 2 ou mais casas decimais',

            'dtInicioPagamento.required' => 'Data de início do pagamento não preenchida',
            'dtInicioPagamento.date' => 'Data de início do pagamento deve ser uma data',
            'dtInicioPagamento.after' => 'Data de início do pagamento deve ser a partir de amanhã',

            'dtParcela.required' => 'Data das parcelas não preenchida',
            'dtParcela.date' => 'Data das parcelas deve ser uma data',
            'dtParcela.after' => 'Data de início do pagamento deve ser a partir de amanhã',

            'nmEndereco.required' => 'Endereço da obra não preenchido',
            'nmEndereco.string' => 'Endereço da obra não deve ser um valor',
            'nmEndereco.max' => 'Endereço da obra ter no máximo 80 caracteres',

            'anexoArquivo.mimes' => 'Arquivo anexado deve ser do tipo pdf ou docx',

            'cdStatusProposta.required' => 'Selecione o status da proposta',
            'cdStatusProposta.string' => 'Status não deve ser um valor',
            'cdStatusProposta.size' => 'Status da proposta deve ter no máximo 1 caractere',
        ];
    }
}
