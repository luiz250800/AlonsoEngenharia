<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\PropostasExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Proposta;
use App\Models\Cliente;
use App\Http\Requests\CadastroPropostaValidate;
use App\Http\Requests\AlteracaoPropostaValidate;

class PropostaController extends Controller
{
    protected $propostaIndex = 'proposal';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cdUsuario = session('cd_usuario');
        $propostas = Proposta::join('tb_cliente', 'tb_proposta.cd_cliente', '=', 'tb_cliente.cd_cliente')
            ->where('tb_cliente.cd_usuario', '=', $cdUsuario)
            ->select('tb_proposta.*')->get();

        if($propostas->count() > 0){
            $cdUsuario = session('cd_usuario');
            Excel::store(new PropostasExport($propostas), "excelProposta/$cdUsuario/propostas.xlsx");
        }
        return view("$this->propostaIndex.listProposal.listProposal", compact('propostas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cdUsuario = session('cd_usuario');
        $clientes = Cliente::where('cd_usuario', '=', $cdUsuario)->get();
        return view("$this->propostaIndex.registerProposal.registerProposal", compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CadastroPropostaValidate $request)
    {
        $cliente = Cliente::find($request->input("cdCliente"));

        $proposta = new Proposta();
        $proposta->Cliente()->associate($cliente);
        $proposta->nm_endereco_obra = $request->input("nmEndereco");
        $proposta->vl_total = $request->input("vlTotal");
        $proposta->vl_sinal = $request->input("vlSinal");
        $proposta->qt_parcela = $request->input("qtParcela");
        $proposta->vl_parcela = $request->input("vlParcela");
        $proposta->dt_inicio_pagamento = $request->input("dtInicioPagamento");
        $proposta->dt_parcela = $request->input("dtParcela");
        $proposta->tp_status_proposta = $request->input("cdStatusProposta");
        $proposta->save();
        if($request->hasFile('anexoArquivo')) {
            $proposta->nm_arquivo_proposta = $request->file('anexoArquivo')->getClientOriginalName();
            $proposta->nm_caminho_arquivo_proposta = $request->file('anexoArquivo')->store("propostas/$proposta->cd_proposta");
            $proposta->save();
        }
        return redirect("$this->propostaIndex/register")->with('response', 'Proposta cadastrada com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proposta = Proposta::find($id);
        $clientes = Cliente::all();

        return view("$this->propostaIndex.updateProposal.updateProposal", compact(array('proposta', 'clientes')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlteracaoPropostaValidate $request, $id)
    {
        $cliente = Cliente::find($request->input("cdCliente"));

        $proposta = Proposta::find($id);
        $proposta->Cliente()->associate($cliente);
        $proposta->nm_endereco_obra = $request->input("nmEndereco");
        $proposta->vl_total = $request->input("vlTotal");
        $proposta->vl_sinal = $request->input("vlSinal");
        $proposta->qt_parcela = $request->input("qtParcela");
        $proposta->vl_parcela = $request->input("vlParcela");
        $proposta->dt_inicio_pagamento = $request->input("dtInicioPagamento");
        $proposta->dt_parcela = $request->input("dtParcela");
        $proposta->tp_status_proposta = $request->input("cdStatusProposta");
        if($request->hasFile('anexoArquivo')){
            Storage::delete($proposta->nm_caminho_arquivo_proposta);
            $proposta->nm_arquivo_proposta = $request->file('anexoArquivo')->getClientOriginalName();
            $proposta->nm_caminho_arquivo_proposta = $request->file('anexoArquivo')->store("propostas/$proposta->cd_proposta");
        }
        $proposta->save();

        return redirect($this->propostaIndex)->with('response', 'Proposta alterada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proposta = Proposta::find($id);
        if($proposta){
            Storage::delete($proposta->nm_caminho_arquivo_proposta);
            $proposta->delete();
            return redirect($this->propostaIndex)->with('response', 'Proposta excluído com sucesso!');
        }else{
            return redirect($this->propostaIndex)->with('response', 'Proposta não encontrado!');
        }
    }

    public function findProposal(Request $request){
        switch($request->input("tpSearch")){
            case "C":
                $propostas = Proposta::join("tb_cliente", 'tb_proposta.cd_cliente', '=', 'tb_cliente.cd_cliente')
                    ->where('tb_cliente.nm_fantasia_cliente', 'like', "%{$request->input("nmFantasiaCliente")}%")
                    ->select('tb_proposta.*')->get();
                break;
            case "P":
                $propostas = Proposta::whereBetween('created_at', [$request->input("dePeriodo"), $request->input("aPeriodo")])->get();
                break;
            case "S":
                $propostas = Proposta::where('tp_status_proposta', '=', $request->input("tpStatus"))->get();
                break;
            default:
                return redirect($this->propostaIndex)->with('response', 'Tipo de busca não encontrada!');
        }

        if($propostas->count() > 0){
            $cdUsuario = session('cd_usuario');
            Excel::store(new PropostasExport($propostas), "excelProposta/$cdUsuario/propostas.xlsx");
        }

        return view("$this->propostaIndex.listProposal.listProposal", compact('propostas'));
    }

    public function updateStatus($id, $tpStatus){
        $proposta = Proposta::find($id);
        $proposta->tp_status_proposta = $tpStatus;
        $proposta->save();
        return redirect($this->propostaIndex)->with('response', 'Status da proposta alterado com sucesso!');
    }

    public function excelExport()
    {
        return Excel::download(new PropostasExport, 'propostas.xlsx');
    }
}
