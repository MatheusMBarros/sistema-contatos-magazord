# Projeto de Gerenciamento de Contatos com PHP, Doctrine ORM e Docker

Este projeto demonstra um sistema simples de gerenciamento de contatos, utilizando PHP, Doctrine ORM para persistência de dados e Docker para conteinerização.

## Pré-requisitos

Antes de começar, certifique-se de ter os seguintes instalados:

-   **Docker:** Necessário para executar o ambiente de desenvolvimento conteinerizado.
-   **Docker Compose:** Usado para orquestrar os serviços do Docker.

## Configuração do Ambiente

1.  **Clone o Repositório:**
    ```bash
    git clone https://github.com/MatheusMBarros/sistema-contatos-magazord.git
    cd sistema-contatos-magazord
    ```

2.  **Inicializar o Ambiente com Docker Compose:**
    Execute o seguinte comando para construir as imagens e iniciar os contêineres:
    ```bash
        docker-compose up -d --build --remove-orphans
    ```
    Este comando irá:
    - Construir a imagem do serviço `web` a partir do `Dockerfile`.
    - Iniciar o contêiner do banco de dados `db` (MySQL).
    - Iniciar o contêiner `web` com sua aplicação PHP.
    - Configurar as redes e volumes necessários para os serviços.

3.  **Aguardar a Inicialização:**
    Pode levar alguns minutos para o banco de dados e a aplicação estarem totalmente operacionais na primeira execução.

5.  **Instalando Dependências:**
       Instale as dependencias do composer
     ```bash
         docker exec -it <nome_do_container_web> bash
         cd /var/www/html
         composer install
         exit
     ```
 -  **Observação:** O `<nome_do_container_web>` deve ser substituído pelo nome correto do seu contêiner. O comando `docker ps` ajuda a identificar este nome.

6. Crie as tabelas no banco de dados
    Acesse o container que WEB e esecute o seguinte comando: php bin/doctrine orm:schema-tool:create
   
6. Abra seu navegador e acesse `http://localhost:8080`

## Executando a Aplicação

Após a configuração do ambiente, você pode interagir com a aplicação através do navegador:

-   **Listar Pessoas:** Acesse `http://localhost:8080/pessoas` para visualizar a lista de pessoas cadastradas.
-   **Adicionar Pessoa:**  Clique no botão de "Adicionar pessoa" dentro da tela de `http://localhost:8080/pessoas` e preencha o formulário.
-    **Editar Pessoa:**  Clique no botão de "Editar" dentro da tela de `http://localhost:8080/pessoas` e preencha o formulário.
-    **Excluir Pessoa:**  Clique no botão de "Excluir" dentro da tela de `http://localhost:8080/pessoas`.
-   **Listar Contatos:** Acesse `http://localhost:8080/contatos` para visualizar a lista de contatos cadastrados.
-   **Filtrar Contatos por Pessoa:** Acesse `http://localhost:8080/contatos?pessoa_id=<ID_DA_PESSOA>`
-   **Adicionar Contato:** Clique no botão de "Adicionar contato" dentro da tela de `http://localhost:8080/contatos` e preencha o formulário.
-    **Editar Contato:**  Clique no botão de "Editar" dentro da tela de `http://localhost:8080/contatos` e preencha o formulário.
-    **Excluir Contato:**  Clique no botão de "Excluir" dentro da tela de `http://localhost:8080/contatos`.

## Comandos Úteis do Doctrine

Para executar os comandos do Doctrine ORM, você pode usar o seguinte comando dentro do container `web`:

```bash
docker exec -it <nome_do_container_web>  /var/www/html/bin/doctrine <comando>
Criar Tabelas: Para criar as tabelas do banco de dados, execute:

 docker exec -it <nome_do_container_web>  /var/www/html/bin/doctrine orm:schema-tool:create
(Para descobrir o nome do container web execute docker ps)

Atualizar Schema: Para atualizar o schema do banco de dados, execute:

 docker exec -it <nome_do_container_web>  /var/www/html/bin/doctrine orm:schema-tool:update --force
(Para descobrir o nome do container web execute docker ps)

Estrutura do Projeto
A estrutura do projeto é organizada da seguinte forma:

docker-compose.yml: Arquivo de configuração do Docker Compose.
Dockerfile: Arquivo para construir a imagem do contêiner da aplicação PHP.
app/: Pasta raiz da aplicação PHP.
app/index.php: Front controller que roteia as requisições para os controladores apropriados.
app/routes/routes.php: Define as rotas da aplicação.
app/Models/: Define as entidades do Doctrine ORM (Pessoa e Contato).
app/Controller/: Contém os controladores da aplicação (PessoaController e ContatoController).
app/View/: Contém as views (formulários e listagens).
app/bootstrap.php: Inicialização do Doctrine ORM, gerenciamento de dependências e definições de variáveis globais.
app/bin/doctrine: Executa os comandos do doctrine.
app/cli-config.php: configuração do doctrine
config/: Contém arquivo de configurações do xdebug.
Sobre o Xdebug
Configuração: O Xdebug está pré-configurado no Dockerfile e a configuração adicional está no arquivo config/xdebug.ini.
Debug: Caso utilize alguma IDE para debugar o código, as configurações do Xdebug devem estar adequadas com a IDE utilizada.
