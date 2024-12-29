<?php

namespace Controller;

use Models\Contato;
use Models\Pessoa;
use Doctrine\ORM\EntityManagerInterface;

class ContatoController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index()
    {
         try {
            $contatos = $this->entityManager->getRepository(Contato::class)->findAll();
             $pessoas = $this->entityManager->getRepository(Pessoa::class)->findAll();
        } catch (\Exception $e) {
            $this->renderView('error', ['message' => 'Erro ao consultar contatos: ' . $e->getMessage()]);
           return;
        }

        $pessoaId = $_GET['pessoa_id'] ?? null;

         if ($pessoaId) {
            $contatos = $this->entityManager->getRepository(Contato::class)->findBy(['pessoa' => $pessoaId]);
        }

        $this->renderView('contatos/cadastro', ['contatos' => $contatos,'pessoas' => $pessoas, 'pessoaId' => $pessoaId]);
    }


   public function showEditForm(int $id)
   {
        try {
             $contato = $this->entityManager->getRepository(Contato::class)->find($id);
             $pessoas = $this->entityManager->getRepository(Pessoa::class)->findAll();

            if (!$contato) {
                $this->renderView('error', ['message' => 'Contato não encontrado.']);
                return;
            }
            $this->renderView('contatos/edit', ['contato' => $contato, 'pessoas' => $pessoas]);
        } catch (\Exception $e) {
             $this->renderView('error', ['message' => 'Erro ao carregar formulário de edição: ' . $e->getMessage()]);
             return;
        }
    }

   public function create()
    {
        $pessoaId = $_POST['pessoa_id'] ?? '';
        $tipo = $_POST['tipo'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        
        if (empty($pessoaId) || empty($tipo) || empty($descricao)) {
            $this->renderView('error', ['message' => 'Todos os campos são obrigatórios.']);
            return;
        }
      try{
            $pessoa = $this->entityManager->getRepository(Pessoa::class)->find($pessoaId);
            if (!$pessoa) {
                $this->renderView('error', ['message' => 'Pessoa não encontrada.']);
                return;
            }

            $contato = new Contato();
            $contato->setPessoa($pessoa);
            $contato->setTipo($tipo);
            $contato->setDescricao($descricao);


            $this->entityManager->persist($contato);
            $this->entityManager->flush();

            header('Location: /contatos');
      } catch (\Exception $e) {
           $this->renderView('error', ['message' => 'Erro ao cadastrar contato: ' . $e->getMessage()]);
            return;
      }
    }

    public function update(int $id)
    {
       try{
            $contato = $this->entityManager->getRepository(Contato::class)->find($id);
             if (!$contato) {
                $this->renderView('error', ['message' => 'Contato não encontrado.']);
                return;
            }

            $pessoaId = $_POST['pessoa_id'] ?? '';
            $tipo = $_POST['tipo'] ?? '';
            $descricao = $_POST['descricao'] ?? '';
            
            if (empty($pessoaId) || empty($tipo) || empty($descricao)) {
                $this->renderView('error', ['message' => 'Todos os campos são obrigatórios.']);
                 return;
            }
            
             $pessoa = $this->entityManager->getRepository(Pessoa::class)->find($pessoaId);
            if (!$pessoa) {
                $this->renderView('error', ['message' => 'Pessoa não encontrada.']);
                return;
            }

            $contato->setPessoa($pessoa);
            $contato->setTipo($tipo);
            $contato->setDescricao($descricao);

            $this->entityManager->flush();

           header('Location: /contatos');
        }  catch (\Exception $e) {
             $this->renderView('error', ['message' => 'Erro ao atualizar contato: ' . $e->getMessage()]);
            return;
       }

    }

   public function delete(int $id)
   {
        try {
            $contato = $this->entityManager->getRepository(Contato::class)->find($id);
            if (!$contato) {
                 $this->renderView('error', ['message' => 'Contato não encontrado.']);
                 return;
            }

             $this->entityManager->remove($contato);
             $this->entityManager->flush();

             header('Location: /contatos');
        } catch (\Exception $e) {
             $this->renderView('error', ['message' => 'Erro ao excluir contato: ' . $e->getMessage()]);
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