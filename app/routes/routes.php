<?php

use Controller\PessoaController;
use Controller\ContatoController;

require_once(__DIR__ . '/../bootstrap.php');

return [
    '/pessoas' => function () use ($entityManager) {
        $controller = new PessoaController($entityManager);
        $controller->index();
    },
    '/pessoas/cadastrar' => function () use ($entityManager) {
        $controller = new PessoaController($entityManager);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->create();
        } else {
           header('Location: /pessoas');
        }
    },
    '/pessoas/editar/{id}' => function ($id) use ($entityManager) {
        $controller = new PessoaController($entityManager);
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
           $controller->update($id);
        }else{
           $controller->showEditForm($id);
        }
    },
    '/pessoas/excluir/{id}' => function ($id) use ($entityManager) {
       $controller = new PessoaController($entityManager);
        $controller->delete($id);
    },
    '/contatos' => function () use ($entityManager) {
        $controller = new ContatoController($entityManager);
        $controller->index();
    },
    '/contatos/cadastrar' => function () use ($entityManager) {
        $controller = new ContatoController($entityManager);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->create();
        } else {
            header('Location: /contatos');
        }
    },
    '/contatos/editar/{id}' => function ($id) use ($entityManager) {
        $controller = new ContatoController($entityManager);
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
           $controller->update($id);
        }else{
           $controller->showEditForm($id);
        }
    },
    '/contatos/excluir/{id}' => function ($id) use ($entityManager) {
        $controller = new ContatoController($entityManager);
        $controller->delete($id);
    },
];