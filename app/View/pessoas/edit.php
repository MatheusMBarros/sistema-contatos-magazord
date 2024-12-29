<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pessoa</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
             display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        form {
            width: 50%;
            padding: 20px;
             background-color: #fff;
             border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
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
         .custom-input {
              margin-bottom: 15px;
          }
    </style>
</head>
<body>
<div class="container">
     <div class="text-left mt-3">
            <a href="/" class="btn btn-secondary">Voltar para Home</a>
        </div>
    <h1>Editar Pessoa</h1>
     <hr>
    <form method="POST" action="/pessoas/editar/<?= $pessoa->getId() ?>">
       <div class="custom-input">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" name="nome" value="<?= htmlspecialchars($pessoa->getNome()) ?>" required>
         </div>
       <div class="custom-input">
            <label for="cpf">CPF:</label>
            <input type="text" class="form-control" name="cpf" value="<?= htmlspecialchars($pessoa->getCpf()) ?>" required>
         </div>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
         <a href="/pessoas" class="btn btn-secondary">Voltar</a>
    </form>
</div>
</body>
</html>