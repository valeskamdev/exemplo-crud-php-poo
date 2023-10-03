<?php
require_once "conecta.php";

function lerFabricantes( PDO $conexao ):array {
    $sql = "SELECT * FROM fabricantes ORDER BY nome";
    
    try {
        $consulta = $conexao->prepare($sql);
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $erro) {
        die("Erro: ".$erro->getMessage());
    }    

    return $resultado;
} 


function inserirFabricante(PDO $conexao, string $nomeDoFabricante):void {
    $sql = "INSERT INTO fabricantes(nome) VALUES(:nome)";

    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":nome", $nomeDoFabricante, PDO::PARAM_STR);
        $consulta->execute();
    } catch (Exception $erro) {
        die("Erro ao inserir: ".$erro->getMessage());
    }

}


function lerUmFabricante(PDO $conexao, int $idFabricante):array {
    $sql = "SELECT * FROM fabricantes WHERE id = :id";

    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":id", $idFabricante, PDO::PARAM_INT);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $erro) {
        die("Erro ao carregar: ".$erro->getMessage());
    }

    return $resultado;
} 


function atualizarFabricante(PDO $conexao, string $nome, int $id):void {
    $sql = "UPDATE fabricantes SET nome = :nome WHERE id = :id";
    
    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":nome", $nome, PDO::PARAM_STR);
        $consulta->bindValue(":id", $id, PDO::PARAM_INT);
        $consulta->execute();
    } catch (Exception $erro) {
        die("Erro ao atualizar: ".$erro->getMessage());
    }
} 

function excluirFabricante(PDO $conexao, int $id):void {
    $sql = "DELETE FROM fabricantes WHERE id = :id";
    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":id", $id, PDO::PARAM_INT);
        $consulta->execute();
    } catch (Exception $erro) {
        die("Erro ao excluir: ".$erro->getMessage());
    }
} 

