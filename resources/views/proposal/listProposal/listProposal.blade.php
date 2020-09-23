<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alonso Engenharia</title>
    <link rel="sortcut icon" href="../images/logo.png" type="image/x-icon" />

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
    .buttons a:first-child {
        margin-top: 10px;
    }
    .thead {
        background-color: #ffc107;
    }
</style>

<div class="row">
    <div class="col-sm-3">
        <div class="card buttons">
            <a href="/client/register" class="btn btn-warning">Cadastro de Clientes</a>
            <a href="/client" class="btn btn-warning">Listar/Editar Clientes</a>
            <a href="/proposal/register" class="btn btn-warning">Nova proposta</a>
            <a href="/proposal" class="btn btn-warning">Lista de propostas</a>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="card">
            <div class="card-body text-left">
                <form method="POST" action="/proposal/findProposal">
                    <div class="d-flex bd-highlight mb-4">
                        <div class="mr-auto p-2 bd-highlight">
                            <h5 class="card-title">Lista de propostas</h5>
                        </div>
                        @csrf
                        <div id="texts" class="p-2 bd-highlight col-md-3">
                            <input type="text" class="form-control" id="nmFantasiaCliente" name="nmFantasiaCliente" placeholder="Buscar por nome fantasia do cliente">
                        </div>
                        <div class="p-2 bd-highlight">
                            <select class="form-control" onchange="modifySearch(this.value)" id="tpSearch" name="tpSearch">
                                <option value="C">Cliente</option>
                                <option value="P">Período</option>
                                <option value="S">Status</option>
                            </select>
                        </div>
                        <div class="p-2 bd-highlight">
                            <button type="submit" class="btn btn-warning">Buscar</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead">
                        <tr>
                            <th scope="col">Cliente</th>
                            <th scope="col">Proposta feita em</th>
                            <th scope="col">Início do pgto.</th>
                            <th scope="col">Qtde de parcelas</th>
                            <th scope="col">Sinal R$</th>
                            <th scope="col">Valor da Parcela</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Abrir/Fechar</th>
                            <th scope="col">Ampliar</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Excluir</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($propostas as $proposta)
                            <div id="accordion">
                                <tr>
                                    <td>{{$proposta->cliente->nm_fantasia_cliente}}</td>
                                    <td>{{date('d/m/Y', strtotime($proposta->created_at))}}</td>
                                    <td>{{date('d/m/Y', strtotime($proposta->dt_inicio_pagamento))}}</td>
                                    <td>{{$proposta->cd_proposta}}</td>
                                    <td>{{$proposta->qt_parcela}}</td>
                                    <td>{{$proposta->vl_sinal}}</td>
                                    <td>{{$proposta->vl_total}}</td>
                                    <td>{{$proposta->tp_status_proposta == "A" ? "Aberta" : "Fechada"}}</td>
                                    <td id="heading{{$proposta->cd_proposta}}">
                                        <a href="/proposal/updateStatus/{{$proposta->cd_proposta}}/A" type="submit" class="btn btn-outline-warning">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check2-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M15.354 2.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L8 9.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                                            </svg>
                                        </a>
                                        <a href="/proposal/updateStatus/{{$proposta->cd_proposta}}/F" type="submit" class="btn btn-outline-warning">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                                            </svg>
                                        </a>
                                    </td>
                                    <td id="heading{{$proposta->cd_proposta}}">
                                        <button type="button" class="btn btn-outline-warning" data-toggle="collapse" data-target="#collapse{{$proposta->cd_proposta}}" aria-expanded="false" aria-controls="collapse{{$proposta->cd_proposta}}">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-list" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"></path>
                                            </svg>
                                        </button>
                                    </td>
                                    <td>
                                        <form method="GET" action="/proposal/update/{{$proposta->cd_proposta}}">
                                            <button type="submit" class="btn btn-outline-warning">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="GET" action="/proposal/delete/{{$proposta->cd_proposta}}">
                                            <button type="submit" class="btn btn-outline-warning">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="12" id="collapse{{$proposta->cd_proposta}}" class="collapse" aria-labelledby="heading{{$proposta->cd_proposta}}" data-parent="#accordion">
                                        <div class="d-flex bd-highlight">
                                            <div class="p-2 flex-fill bd-highlight">Cliente: {{$proposta->cliente->nm_fantasia_cliente}}</div>
                                            <div class="p-2 flex-fill bd-highlight">Endereço da obra: {{$proposta->nm_endereco_obra}}</div>
                                            <div class="p-2 flex-fill bd-highlight">Valor total: {{$proposta->vl_total}}</div>
                                        </div>
                                        <div class="d-flex bd-highlight">
                                            <div class="p-2 flex-fill bd-highlight">Sinal: {{$proposta->vl_sinal}}</div>
                                            <div class="p-2 flex-fill bd-highlight">Quantidade de parcelas: {{$proposta->qt_parcela}}</div>
                                            <div class="p-2 flex-fill bd-highlight">Valor da parcela: {{$proposta->vl_parcela}}</div>
                                        </div>
                                        <div class="d-flex bd-highlight">
                                            <div class="p-2 flex-fill bd-highlight">Data de início do pagamento: {{date('d/m/Y', strtotime($proposta->dt_inicio_pagamento))}}</div>
                                            <div class="p-2 flex-fill bd-highlight">Data da parcela: {{date('d/m/Y', strtotime($proposta->dt_parcela))}}</div>
                                            @if($proposta->nm_arquivo_proposta)
                                            <div class="p-2 flex-fill bd-highlight">
                                                Arquivo da proposta:
                                                <a href="{{env('APP_URL')}}/storage/{{$proposta->nm_caminho_arquivo_proposta}}" class="text-warning">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                        <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                                    </svg>
                                                    {{$proposta->nm_arquivo_proposta}}
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @if($propostas->count() > 0)
                <a type="button" href="{{env('APP_URL')}}/storage/excelProposta/{{session('cd_usuario')}}/propostas.xlsx" class="btn btn-warning">Exportar</a>
                @endif
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

@if(session('response'))
    <div class="modal fade" id="responseModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Retorno</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{session('response')}}
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

    function modifySearch(tpSearch) {
        switch (tpSearch) {
            case 'C':
                $('#texts').html('<input type="text" class="form-control" id="nmFantasiaCliente" name="nmFantasiaCliente" placeholder="Buscar por nome fantasia do cliente">');
                break;
            case 'P':
                $('#texts').html('Buscar por proposta feita de: <input type="date" class="form-control" id="dePeriodo" name="dePeriodo"> a: <input type="date" class="form-control" id="aPeriodo" name="aPeriodo">')
                break;
            case 'S':
                $('#texts').html('<select class="form-control" id="tpStatus" name="tpStatus">\n' +
                    '<option value="A">Aberto</option>' +
                    '<option value="F">Fechada</option>' +
                    '</select>');
                break;
        }
    }
</script>
</body>
</html>
