<?php

namespace ExemploCrudPoo;

use PDO;

class Fabricante
{
    private int $id;
    private string $nome;
    private PDO $conexao;

    public function __construct() {
        /**
         * No momento em que um objeto Fabricante for criado, automaticamnte
         * será feita a chamada do método "conecta" da classe Banco.
         */
        $this->conexao = Banco::conecta();
    }

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
}