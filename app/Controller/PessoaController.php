<?php

namespace Controller;

use Models\Pessoa;
use Doctrine\ORM\EntityManagerInterface;

class PessoaController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index()
    {
        $nomePesquisa = $_GET['search_nome'] ?? '';

        try {
            if (empty($nomePesquisa)) {
                $pessoas = $this->entityManager->getRepository(Pessoa::class)->findAll();
            } else {
                $pessoas = $this->entityManager->getRepository(Pessoa::class)
                    ->createQueryBuilder('p')
                    ->where('p.nome LIKE :nome')
                    ->setParameter('nome', '%' . $nomePesquisa . '%')
                    ->getQuery()
                    ->getResult();
            }
        } catch (\Exception $e) {
           $this->renderView('error', ['message' => 'Erro ao consultar pessoas: ' . $e->getMessage()]);
           return;
        }

        $this->renderView('pessoas/cadastro', ['pessoas' => $pessoas, 'nomePesquisa' => $nomePesquisa]);
    }

    public function showEditForm(int $id)
    {
        try {
            $pessoa = $this->entityManager->getRepository(Pessoa::class)->find($id);
            if (!$pessoa) {
                 $this->renderView('error', ['message' => 'Pessoa não encontrada.']);
                 return;
            }
           $this->renderView('pessoas/edit', ['pessoa' => $pessoa]);
        } catch (\Exception $e) {
           $this->renderView('error', ['message' => 'Erro ao carregar formulário de edição: ' . $e->getMessage()]);
            return;
        }
    }

    public function create()
    {
        $nome = $_POST['nome'] ?? '';
        $cpf = $_POST['cpf'] ?? '';
        if (empty($nome) || empty($cpf)) {
             $this->renderView('error', ['message' => 'Nome e CPF são obrigatórios.']);
             return;
        }

        $existingPessoa = $this->entityManager->getRepository(Pessoa::class)->findOneBy(['cpf' => $cpf]);
        if ($existingPessoa) {
           $this->renderView('error', ['message' => 'Erro: CPF já cadastrado.']);
           return;
        }

        try {
            $pessoa = new Pessoa();
            $pessoa->setNome($nome);
            $pessoa->setCpf($cpf);

            $this->entityManager->persist($pessoa);
            $this->entityManager->flush();

            header('Location: /pessoas');
        } catch (\Exception $e) {
             $this->renderView('error', ['message' => 'Erro ao cadastrar pessoa: ' . $e->getMessage()]);
            return;
        }
    }

    public function update(int $id)
    {
        try {
            $pessoa = $this->entityManager->getRepository(Pessoa::class)->find($id);
            if (!$pessoa) {
                 $this->renderView('error', ['message' => 'Pessoa não encontrada.']);
                 return;
            }

            $nome = $_POST['nome'] ?? '';
            $cpf = $_POST['cpf'] ?? '';

            $pessoa->setNome($nome);
            $pessoa->setCpf($cpf);

            $this->entityManager->flush();

            header('Location: /pessoas');
        } catch (\Exception $e) {
           $this->renderView('error', ['message' => 'Erro ao editar pessoa: ' . $e->getMessage()]);
             return;
        }
    }

    public function delete(int $id)
    {
        try {
            $pessoa = $this->entityManager->getRepository(Pessoa::class)->find($id);
            if (!$pessoa) {
                 $this->renderView('error', ['message' => 'Pessoa não encontrada.']);
                 return;
            }

            $this->entityManager->remove($pessoa);
            $this->entityManager->flush();

            header('Location: /pessoas');
        } catch (\Exception $e) {
            $this->renderView('error', ['message' => 'Erro ao excluir pessoa: ' . $e->getMessage()]);
           return;
        }
    }

    protected function renderView($viewPath, $data = [])
    {
        extract($data);
        ob_start();
        include __DIR__ . '/../View/' . $viewPath . '.php';
        $content = ob_get_clean();
        echo $content;
    }
}