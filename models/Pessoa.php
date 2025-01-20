<?php

namespace models;

use Banco;
use PDO;
use stdClass;

include_once("./DB.php");

class Pessoa
{
    public $dbConexao;

    public function __construct()
    {
        $this->dbConexao = new Banco();
    }

    public function todos()
    {
        try {
            $this->dbConexao->conexao();

            $nome = isset($_REQUEST["nome"]) ? $_REQUEST["nome"] . "%" : NULL;

            $sql = "SELECT * FROM pessoas WHERE nome LIKE ? ORDER BY id DESC LIMIT 8";
            $stmt = $this->dbConexao->pdo->prepare($sql);
            $stmt->execute([$nome]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return [];
        }
    }
    public function existe($dados)
    {
        try {
            $this->dbConexao->conexao();

            $id = isset($dados["id"]) ? $dados["id"] : 0;
            $nome = isset($dados["nome"]) ? $dados["nome"] : NULL;
            $idade = isset($dados["idade"]) ? $dados["idade"] : NULL;

            $sql = "SELECT * FROM pessoas WHERE nome = :nome AND idade = :idade AND id <> :id";
            $stmt = $this->dbConexao->pdo->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":idade", $idade);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            print_r($th->getMessage());
            return NULL;
        }
    }

    public function pegarPorId()
    {
        try {
            $this->dbConexao->conexao();

            $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : NULL;

            if (!is_numeric($id)) {
                return NULL;
            }

            $sql = "SELECT * FROM pessoas WHERE id = $id";
            $stmt = $this->dbConexao->pdo->query($sql);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            print_r($th->getMessage());
            return NULL;
        }
    }

    public function cadastrar($dados)
    {
        try {
            $this->dbConexao->conexao();

            $nome = isset($dados["nome"]) ? $dados["nome"] : NULL;
            $idade = isset($dados["idade"]) ? $dados["idade"] : NULL;

            $retorno = new stdClass;
            $retorno->erro = FALSE;
            $retorno->msg = NULL;


            $sql = "INSERT INTO pessoas (nome, idade) VALUES (:nome, :idade)";
            $stmt = $this->dbConexao->pdo->prepare($sql);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->bindParam(":idade", $idade, PDO::PARAM_INT);
            $stmt->execute();

            return $retorno;
        } catch (\Throwable $th) {
            $retorno = new stdClass;
            $retorno->erro = TRUE;
            $retorno->msg = print_r($th->getMessage());

            return $retorno;
        }
    }

    public function editar($dados)
    {
        try {
            $this->dbConexao->conexao();

            $id = isset($dados["id"]) ? $dados["id"] : NULL;
            $nome = isset($dados["nome"]) ? $dados["nome"] : NULL;
            $idade = isset($dados["idade"]) ? $dados["idade"] : NULL;

            $retorno = new stdClass;
            $retorno->erro = FALSE;
            $retorno->msg = NULL;

            $sql = "UPDATE pessoas SET nome = :nome, idade = :idade WHERE id = :id";
            $stmt = $this->dbConexao->pdo->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
            $stmt->bindParam(":idade", $idade, PDO::PARAM_INT);
            $stmt->execute();

            return $retorno;
        } catch (\Throwable $th) {
            $retorno = new stdClass;
            $retorno->erro = TRUE;
            $retorno->msg = print_r($th->getMessage());

            return $retorno;
        }
    }

    public function excluir($id)
    {
        try {
            $this->dbConexao->conexao();

            $retorno = new stdClass();
            $retorno->erro = FALSE;
            $retorno->msg = NULL;

            $sql = "DELETE FROM pessoas WHERE id = :id";
            $stmt = $this->dbConexao->pdo->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            return $retorno;
        } catch (\Throwable $th) {
            $retorno = new stdClass();
            $retorno->erro = TRUE;
            $retorno->msg = $th->getMessage();

            return $retorno;
        }
    }
}
