<?php

namespace ExemploCrudPoo;

use PDO, Exception;

class Produto
{
    private int $id;
    private string $nome;
    private string $descricao;
    private float $preco;
    private int $quantidade;
    private int $fabricanteId;
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = Banco::conecta();
    }

    public function ler(): array
    {
        $sql = "SELECT 
                produtos.id,
                produtos.nome AS produto,
                produtos.preco,
                produtos.quantidade,
                fabricantes.nome AS fabricante,
                (produtos.preco * produtos.quantidade) AS total
            FROM produtos INNER JOIN fabricantes
            ON produtos.fabricante_id = fabricantes.id
            ORDER BY produto";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao carregar produtos: " . $erro->getMessage());
        }

        return $resultado;
    }

    function inserir(): void
    {
        $sql = "INSERT INTO produtos(
        nome, preco, quantidade, descricao, fabricante_id
    ) VALUES(
        :nome, :preco, :quantidade, :descricao, :fabricanteId
    )";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $this->nome, PDO::PARAM_STR);
            $consulta->bindValue(":preco", $this->preco, PDO::PARAM_STR);
            $consulta->bindValue(":quantidade", $this->quantidade, PDO::PARAM_INT);
            $consulta->bindValue(":descricao", $this->descricao, PDO::PARAM_STR);
            $consulta->bindValue(":fabricanteId", $this->fabricanteId, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao inserir: " . $erro->getMessage());
        }
    }

    function lerUm():array {
        $sql = "SELECT * FROM produtos WHERE id = :id";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao carregar dados: ".$erro->getMessage());
        }
        return $resultado;
    }



    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = filter_var(
          $descricao,
          FILTER_SANITIZE_SPECIAL_CHARS
        );
    }

    public function getPreco(): float
    {
        return $this->preco;
    }

    public function setPreco(float $preco): void
    {
        $this->preco = filter_var(
          $preco,
          FILTER_SANITIZE_NUMBER_FLOAT,
          FILTER_FLAG_ALLOW_FRACTION
        );
    }

    public function getQuantidade(): int
    {
        return $this->quantidade;
    }

    public function setQuantidade(int $quantidade): void
    {
        $this->quantidade = filter_var($quantidade, FILTER_SANITIZE_NUMBER_INT);
    }

    public function getFabricanteId(): int
    {
        return $this->fabricanteId;
    }

    public function setFabricanteId(int $fabricanteId): void
    {
        $this->fabricanteId = filter_var($fabricanteId, FILTER_SANITIZE_NUMBER_INT);
    }

    public function getConexao(): PDO
    {
        return $this->conexao;
    }

    public function setConexao(PDO $conexao): void
    {
        $this->conexao = $conexao;
    }
}