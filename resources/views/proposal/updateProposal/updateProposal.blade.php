<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alonso Engenharia</title>
    <link rel="sortcut icon" href="../../images/logo.png" type="image/x-icon" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <meta name="theme-color" content="#563d7c">
</head>
<body>
<style>
    .btn {
        margin-bottom: 10px;
    }
    .row {
        margin-top: 2rem;
        margin-left: 1rem;
        margin-bottom: 2rem;
    }
    .card a:first-child {
        margin-top: 10px;
    }
</style>

<div class="row">
    <div class="col-sm-3">
        <div class="card">
            <a href="/client/register" class="btn btn-warning">Cadastro de Clientes</a>
            <a href="/client" class="btn btn-warning">Listar/Editar Clientes</a>
            <a href="/proposal/register" class="btn btn-warning">Nova proposta</a>
            <a href="/proposal" class="btn btn-warning">Lista de propostas</a>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="card">
            <div class="card-body text-left">
                <h5 class="card-title">Alterar proposta</h5>
                <form method="POST" action="/proposal/update/{{$proposta->cd_proposta}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="cliente">Cliente</label>
                        <select class="form-control" id="cdCliente" name="cdCliente">
                            @foreach($clientes as $cliente)
                                <option value="{{$cliente->cd_cliente}}" {{$proposta->cd_cliente == $cliente->cd_cliente ? "selected" : ""}}>{{$cliente->nm_fantasia_cliente}}</option>
                            @endforeach
                        </select>
                        <small id="clienteHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="endereco">Endereço da obra</label>
                        <input type="text" class="form-control" id="nmEndereco" name="nmEndereco" value="{{$proposta->nm_endereco_obra}}" placeholder="Digite o endereço da obra" maxlength="80">
                        <small id="enderecoHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="vlTotal">Valor total</label>
                        <input type="text" class="form-control" id="vlTotal" name="vlTotal" value="{{$proposta->vl_total}}" placeholder="Digite o valor total da proposta" maxlength="9">
                        <small id="vlTotalHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="sinal">Sinal</label>
                        <input type="text" class="form-control" id="vlSinal" name="vlSinal" value="{{$proposta->vl_sinal}}" placeholder="Digite o valor do sinal" maxlength="8">
                        <small id="sinalHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="quantidadeParcela">Quantidade de parcelas</label>
                        <input type="number" class="form-control" id="qtParcela" name="qtParcela" value="{{$proposta->qt_parcela}}" placeholder="Digite a quantidade de parcelas" maxlength="2">
                        <small id="quantidadeParcelaHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="valorParcela">Valor das parcelas</label>
                        <input type="text" class="form-control" id="vlParcela" name="vlParcela" value="{{$proposta->vl_parcela}}" placeholder="Digite o valor das parcelas" maxlength="9">
                        <small id="valorParcelaHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="dataInicioPagamento">Data de início do pagamento</label>
                        <input type="date" class="form-control" id="dtInicioPagamento" value="{{$proposta->dt_inicio_pagamento}}" name="dtInicioPagamento" placeholder="Digite a data de início do pagamento">
                        <small id="dataInicioPagamentoHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="dataParcela">Data das parcelas</label>
                        <input type="date" class="form-control" id="dtParcela" value="{{$proposta->dt_parcela}}" name="dtParcela" placeholder="Digite a data das parcelas">
                        <small id="dataParcelaHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="anexoArquivo">Anexar arquivo (PDF ou DOC)</label>
                        <input type="file" class="form-control-file" id="anexoArquivo" name="anexoArquivo">
                        Anexo atual:
                        <a href="{{env('APP_URL')}}/storage/{{$proposta->nm_caminho_arquivo_proposta}}" class="text-warning">
                            {{$proposta->nm_arquivo_proposta}}
                        </a>
                    </div>
                    <div class="form-group">
                        <label for="statusProposta">Status da proposta</label>
                        <select class="form-control" id="cdStatusProposta" name="cdStatusProposta">
                            <option value="A" {{$proposta->tp_status_proposta == "A" ? "selected" : ""}}>Aberto</option>
                            <option value="F" {{$proposta->tp_status_proposta == "F" ? "selected" : ""}}>Fechada</option>
                        </select>
                        <small id="statusPropostaHelp" class="form-text text-muted"></small>
                    </div>
                    <button type="submit" class="btn btn-warning">Salvar</button>
                </form>
            </div>
        </div>
    </div>

    <div class="p-2 flex-fill bd-highlight">
        <a href="/logout" type="submit" class="btn btn-outline-warning">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-door-open-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2v13h1V2.5a.5.5 0 0 0-.5-.5H11zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
            </svg>
            Logout
        </a>
    </div>
</div>
@if($errors->any())
    <div class="modal fade" id="responseModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Dados incorretos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
@endif

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('#responseModal').modal('show');
    });
</script>
</body>
</html>
