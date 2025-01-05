<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Contatos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container-flex {
            display: flex;
            justify-content: space-between;
        }
        .col-md-6 {
            width: 48%;
        }
        .custom-card{
        border-radius: 10px;
        background-color: #f8f9fa;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .custom-card-body {
            padding: 20px;
        }
        .custom-input {
            margin-bottom: 15px;
        }
         h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        h3{
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
          <div class="text-left mt-3">
            <a href="/" class="btn btn-secondary">Voltar para Home</a>
        </div>
        <h1>Gerenciar Contatos</h1>
        <hr>
        <div class="container-flex">
        <div class="col-md-6">
            <div class="custom-card">
                <div class="custom-card-body">
                <h3>Cadastrar Contato</h3>
                    <form action="/contatos/cadastrar" method="post">
                        <div class="custom-input">
                            <label for="pessoa_id">Pessoa:</label>
                            <select class="form-control" name="pessoa_id" required>
                                <option>Selecione uma pessoa</option>
                                <?php if(isset($pessoas)): ?>
                                    <?php foreach ($pessoas as $pessoa): ?>
                                        <option value="<?= $pessoa->getId() ?>"><?= $pessoa->getNome() ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="custom-input">
                            <label for="tipo">Tipo:</label>
                            <select class="form-control" name="tipo">
                                <option value="1">Telefone</option>
                                <option value="0">Email</option>
                            </select>
                        </div>
                        <div class="custom-input">
                            <label for="descricao">Descrição:</label>
                            <input type="text" class="form-control" name="descricao" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>

        </div>
    <div class="col-md-6">
        <div class="custom-card">
        <div class="custom-card-body">
            <h3>Lista de Contatos</h3>
                <div class="mb-3">
                    <form action="/contatos" method="get">
                        <label for="pessoa_id">Filtrar por Pessoa:</label>
                        <select class="form-control" name="pessoa_id" onchange="this.form.submit()">
                            <option value="">Todas</option>
                            <?php if(isset($pessoas)): ?>
                                <?php foreach ($pessoas as $pessoa): ?>
                                    <option value="<?= $pessoa->getId() ?>" <?= ($pessoaId == $pessoa->getId()) ? 'selected' : '' ?>><?= $pessoa->getNome() ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </form>
                    <table class="table mt-2">
                        <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Descrição</th>
                            <th>Pessoa</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($contatos as $contato): ?>
                            <tr>
                                <td><?= $contato->getTipo() ? 'Telefone' : 'Email' ?></td>
                                <td><?= $contato->getDescricao() ?></td>
                                <td><?= $contato->getPessoa()->getNome() ?></td>
                                <td>
                                    <a href="/contatos/editar/<?= $contato->getId() ?>" class="btn btn-sm btn-primary">Editar</a>
                                    <a href="/contatos/excluir/<?= $contato->getId() ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>
</html>