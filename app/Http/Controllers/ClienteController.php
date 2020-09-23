<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Usuario;
use App\Http\Requests\CadastroClienteValidate;
use App\Http\Requests\AlteracaoClienteValidate;

class ClienteController extends Controller
{
    protected $clienteIndex = 'client';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cdUsuario = session('cd_usuario');
        $clientes = Cliente::where('cd_usuario', '=', $cdUsuario)->get();
        return view("$this->clienteIndex.listClient.listClient", compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("$this->clienteIndex.registerClient.registerClient");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CadastroClienteValidate $request)
    {
        $cdUsuario = session('cd_usuario');
        $usuario = Usuario::find($cdUsuario);

        $cliente = new Cliente();
        $cliente->Usuario()->associate($usuario);
        $cliente->nm_razao_social_cliente = $request->input("nmRazaoSocial");
        $cliente->nm_fantasia_cliente = $request->input("nmFantasia");
        $cliente->cd_cnpj_cliente = $request->input("cdCnpj");
        $cliente->nm_endereco_cliente = $request->input("nmEndereco");
        $cliente->nm_email_cliente = $request->input("nmEmail");
        $cliente->cd_telefone_cliente = $request->input("cdTelefone");
        $cliente->nm_responsavel_cliente = $request->input("nmResponsavel");
        $cliente->cd_cpf_responsavel_cliente = $request->input("cdCpfResponsavel");
        $cliente->cd_celular_responsavel_cliente = $request->input("cdCelularResponsavel");
        $cliente->save();

        return redirect("$this->clienteIndex/register")->with('response', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);
        return view("$this->clienteIndex.updateClient.updateClient", compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlteracaoClienteValidate $request, $id)
    {
        $cliente = Cliente::find($id);
        $cliente->nm_razao_social_cliente = $request->input("nmRazaoSocial");
        $cliente->nm_fantasia_cliente = $request->input("nmFantasia");
        $cliente->cd_cnpj_cliente = $request->input("cdCnpj");
        $cliente->nm_endereco_cliente = $request->input("nmEndereco");
        $cliente->nm_email_cliente = $request->input("nmEmail");
        $cliente->cd_telefone_cliente = $request->input("cdTelefone");
        $cliente->nm_responsavel_cliente = $request->input("nmResponsavel");
        $cliente->cd_cpf_responsavel_cliente = $request->input("cdCpfResponsavel");
        $cliente->cd_celular_responsavel_cliente = $request->input("cdCelularResponsavel");
        $cliente->save();

        return redirect($this->clienteIndex)->with('response', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        if($cliente){
            $cliente->Proposta()->delete();
            $cliente->delete();
            return redirect($this->clienteIndex)->with('response', 'Cliente excluído com sucesso!');
        }else{
            return redirect($this->clienteIndex)->with('response', 'Cliente não encontrado!');
        }
    }
}
