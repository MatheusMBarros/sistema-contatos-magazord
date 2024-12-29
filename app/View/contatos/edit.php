<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Contato</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <style>
            .custom-input {
              margin-bottom: 15px;
          }
          h1 {
            text-align: center;
            margin-bottom: 30px;
        }
      </style>
</head>
<body>
<div class="container">
     <div class="text-left mt-3">
            <a href="/" class="btn btn-secondary">Voltar para Home</a>
        </div>
    <h1>Editar Contato</h1>
    <hr>
    <form action="/contatos/editar/<?= $contato->getId() ?>" method="post">
        <div class="custom-input">
            <label for="pessoa_id">Pessoa:</label>
            <select class="form-control" name="pessoa_id" required>
                <?php foreach ($pessoas as $pessoa): ?>
                    <option value="<?= $pessoa->getId() ?>" <?= ($contato->getPessoa()->getId() === $pessoa->getId()) ? 'selected' : '' ?>><?= $pessoa->getNome() ?></option>
                <?php endforeach; ?>
            </select>
        </div>
          <div class="custom-input">
            <label for="tipo">Tipo:</label>
            <select class="form-control" name="tipo">
                <option value="1" <?= $contato->getTipo() ? 'selected' : '' ?>>Telefone</option>
                <option value="0" <?= !$contato->getTipo() ? 'selected' : '' ?>>Email</option>
            </select>
        </div>
        <div class="custom-input">
            <label for="descricao">Descrição:</label>
            <input type="text" class="form-control" name="descricao" value="<?= $contato->getDescricao() ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="/contatos" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>