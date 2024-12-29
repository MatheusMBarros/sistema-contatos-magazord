<?php

namespace Models;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="pessoa")
 */
#[ORM\Entity]
#[ORM\Table(name: 'pessoa')]
class Pessoa
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(type: Types::STRING, length: 140)]
    private string $nome;

    #[ORM\Column(type: Types::STRING, length: 14, unique: true)]
    private string $cpf;

    /**
     * @ORM\OneToMany(targetEntity="Models\Contato", mappedBy="pessoa")
     */
    #[ORM\OneToMany(targetEntity: 'Models\Contato', mappedBy: 'pessoa')]
    private $contatos;

    public function __construct()
    {
        $this->contatos = new ArrayCollection();
    }

    // Getters e Setters

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): void
    {
        $this->cpf = $cpf;
    }

    public function getContatos(): ArrayCollection
    {
        return $this->contatos;
    }

    public function addContato(Contato $contato): void
    {
        $this->contatos[] = $contato;
    }
}
