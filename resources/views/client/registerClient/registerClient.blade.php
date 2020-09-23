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
                <h5 class="card-title">Cadastro de clientes</h5>
                <form method="POST" action="/client/register">
                    @csrf
                    <div class="form-group">
                        <label for="razaosocial">Razão Social</label>
                        <input type="text" class="form-control" id="nmRazaoSocial" name="nmRazaoSocial"  placeholder="Digite a razão social do cliente" maxlength="50">
                        <small id="razaoSocialHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="nomeFantasia">Nome Fantasia</label>
                        <input type="text" class="form-control" id="nmFantasia" name="nmFantasia" placeholder="Digite o nome fantasia do cliente" maxlength="60">
                        <small id="nomeFantasiaHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="cnpj">CNPJ</label>
                        <input type="text" class="form-control" id="cdCnpj" name="cdCnpj" placeholder="Digite o CNPJ do cliente" maxlength="15">
                        <small id="cnpjHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="endereco">Endereço</label>
                        <input type="text" class="form-control" id="nmEndereco" name="nmEndereco" placeholder="Digite o endereço do cliente" maxlength="80">
                        <small id="enderecoHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="nmEmail" name="nmEmail" placeholder="Digite o email do cliente" maxlength="50">
                        <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="tel" class="form-control" id="cdTelefone" name="cdTelefone" placeholder="Digite o telefone do cliente" maxlength="10">
                        <small id="telefoneHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="nomeResponsavel">Nome do Responsável</label>
                        <input type="name" class="form-control" id="nmResponsavel" name="nmResponsavel" placeholder="Digite o nome do responsável pelo cliente" maxlength="50">
                        <small id="nomeResponsavelHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control" id="cdCpfResponsavel" name="cdCpfResponsavel" placeholder="Digite o CPF do responsável pelo cliente" maxlength="11">
                        <small id="cpfHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="celular">Celular</label>
                        <input type="tel" class="form-control" id="cdCelularResponsavel" name="cdCelularResponsavel" placeholder="Digite o numero de celular do responsável pelo cliente" maxlength="11">
                        <small id="celularHelp" class="form-text text-muted"></small>
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

@if(session('response'))
    <div class="modal fade" id="responseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Retorno</h5>
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
