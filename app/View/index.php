<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Teste de Desenvolvedor Back-end</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
          /* Resetando margens e padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Corpo da página */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        /* Cabeçalho */
        header {
             background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        /* Título principal */
        h1 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        /* Seção principal */
        main {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.5rem;
            color: #333;
        }

        /* Navegação de opções */
        .options-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .option-card {
           background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 22%;
            margin: 10px 0;
            text-align: center;
            padding: 20px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .option-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .option-card h5 {
            margin-bottom: 15px;
            font-size: 1.2rem;
             color: #007bff;
        }

        .option-card p {
            font-size: 1rem;
            color: #666;
            margin-bottom: 20px;
        }

         .option-card a {
            display: inline-block;
            padding: 10px 20px;
             background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
             font-size: 1rem;
        }

        .option-card a:hover {
            background-color: #0056b3;
        }

        /* Seções sobre o teste */
        section {
            margin-top: 40px;
            text-align: center;
        }

        section h3 {
            font-size: 1.3rem;
              color: #007bff;
            margin-bottom: 15px;
        }

        section p {
            font-size: 1rem;
            color: #333;
        }

        /* Rodapé */
        footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 10px;
             margin-top: 40px;
        }
    </style>
</head>
<body>

    <header>
        <h1>Bem-vindo ao Sistema de Contatos</h1>
    </header>

    <main>
        <h2>Escolha o que deseja fazer:</h2>

        <div class="options-container">
            <div class="option-card">
                <h5> Pessoas</h5>
                <p>Gerencie as pessoas cadastradas no sistema.</p>
                <a href="/pessoas">Acessar</a>
            </div>

            <div class="option-card">
                <h5> Contatos</h5>
                 <p>Gerencie os contatos cadastrados no sistema.</p>
                <a href="/contatos">Acessar</a>
            </div>

        </div>

        <section>
            <h3>Sobre o Teste</h3>
            <p>Este sistema foi criado para trealizar o desafio de desenvolvedor backend da Magazord utilizando: PHP, JavaScript, Banco de Dados MySql, APIs e outras tecnologias. A aplicação segue o padrão MVC e utiliza o Doctrine ORM.</p>
        </section>

        <section>
            <h3>Instruções de Execução</h3>
            <p>Veja o <a href="/README" style="color: #007bff;">README</a> para mais detalhes sobre como executar o projeto localmente e entender como ele funciona.</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 - Teste para Vaga de Desenvolvedor Back-end - Magazord</p>
    </footer>

</body>
</html>