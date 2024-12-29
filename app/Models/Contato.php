<?php

namespace Models;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

/**
 * @ORM\Entity
 * @ORM\Table(name="contatos")
 */
#[ORM\Entity]
#[ORM\Table(name: 'contatos')]
class Contato
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $tipo;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $descricao;

    /**
     * @ORM\ManyToOne(targetEntity="Models\Pessoa")
     * @ORM\JoinColumn(name="pessoa_id", referencedColumnName="id")
     */
    #[ORM\ManyToOne(targetEntity: 'Models\Pessoa')]
    #[ORM\JoinColumn(name: 'pessoa_id', referencedColumnName: 'id')]
    private Pessoa $pessoa;

    // Getters e Setters

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTipo(): bool
    {
        return $this->tipo;
    }

    public function setTipo(bool $tipo): void
    {
        $this->tipo = $tipo;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function getPessoa(): Pessoa
    {
        return $this->pessoa;
    }

    public function setPessoa(Pessoa $pessoa): void
    {
        $this->pessoa = $pessoa;
    }
}
