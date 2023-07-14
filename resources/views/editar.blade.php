<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    </head>
    <body>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center">Editar</h3>
                    <form id="registroForm">
                        <div class="mb-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" value="{{$registro->cpf}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" value="{{$registro->nome}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="sobrenome" class="form-label">Sobrenome</label>
                            <input type="text" class="form-control" id="sobrenome" name="sobrenome" value="{{$registro->sobrenome}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="{{$registro->data_nascimento}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{$registro->email}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="genero" class="form-label">Gênero</label>
                            <select class="form-select" id="genero" name="genero" required>
                            <option value="" disabled selected>Selecione uma opção</option>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Inserir</button>
                            <button type="reset" class="btn btn-secondary">Recomeçar</button>
                            <a href="/" class="btn btn-secondary">Voltar</a>
                        </div>
                        <td>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('registroForm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Obter os dados do formulário
        var formData = new FormData(this);

        // Enviar a requisição POST
        fetch("/api/registros/{{$registro->id}}", {
            method: 'PUT',
            body: formData
        })
        .then(function(response) {
            if (response.ok) {
                alert('Sucesso!');
            } else if (response.status === 422) {
                response.json().then(function(data) {
                    alert('Código de erro: ' + response.status + '\nMensagem de erro: ' + JSON.stringify(data));
                });
            } else {
                alert('Ocorreu um erro na requisição.');
            }
        })
        .catch(function(error) {
            alert('Ocorreu um erro na requisição.');
        });
    });
</script>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
