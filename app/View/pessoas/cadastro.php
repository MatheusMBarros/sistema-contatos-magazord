<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro e Listagem de Pessoas</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 20px;
             background-color: #f8f9fa;
        }
        .container-flex {
             display: flex;
            justify-content: space-between;
        }
         .col-md-6 {
            width: 48%;
        }
         .custom-card{
            border-radius: 10px;
             background-color: #fff;
              box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .custom-card-body {
            padding: 20px;
        }
        form {
            width: 100%;
            padding: 0px;
            border: none;
             margin-bottom: 30px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
          .custom-input {
              margin-bottom: 15px;
          }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        h1 {
            text-align: center;
             margin-bottom: 30px;
        }
        h2 {
             margin-bottom: 20px;
        }

    </style>
</head>
<body>
    <div class="container">
         <div class="text-left mt-3">
            <a href="/" class="btn btn-secondary">Voltar para Home</a>
        </div>
    <h1>Cadastro e Listagem de Pessoas</h1>
<hr>
    <div class="container-flex">
        <div class="col-md-6">
        <div class="custom-card">
            <div class="custom-card-body">
                 <h2>Cadastrar Nova Pessoa</h2>
                    <form method="POST" action="/pessoas/cadastrar">
                       <div class="custom-input">
                            <label for="nome">Nome:</label>
                            <input type="text" class="form-control" name="nome" required />
                         </div>
                         <div class="custom-input">
                                <label for="cpf">CPF:</label>
                                <input type="text" class="form-control" name="cpf" required />
                            </div>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
            </div>
        </div>
        </div>
        <div class="col-md-6">
                <div class="custom-card">
                    <div class="custom-card-body">
                         <h2>Lista de Pessoas</h2>
                        <form method="GET" action="/pessoas">
                            <div class="search-container">
                                <label for="search_nome">Pesquisar por nome:</label>
                                <input type="text" class="form-control" name="search_nome" id="search_nome" placeholder="Digite o nome" />
                            </div>
                            <button type="submit" class="btn btn-secondary">Pesquisar</button>
                        </form>


                        <table class="table mt-2">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($pessoas)) : ?>
                                <?php if(empty($pessoas)): ?>
                                    <tr>
                                        <td colspan="3">Nenhuma pessoa encontrada.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($pessoas as $pessoa): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($pessoa->getNome()) ?></td>
                                            <td><?= htmlspecialchars($pessoa->getCpf()) ?></td>
                                            <td>
                                                <a href="/pessoas/editar/<?= $pessoa->getId() ?>" class="btn btn-sm btn-primary">Editar</a>
                                                <a href="/pessoas/excluir/<?= $pessoa->getId() ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
    </div>
</body>
</html>