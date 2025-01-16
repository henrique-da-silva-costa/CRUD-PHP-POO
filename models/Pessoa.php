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

    public function cadastrar($dados)
    {
        try {
            $nome = isset($dados["nome"]) ? $dados["nome"] : NULL;
            $idade = isset($dados["idade"]) ? $dados["idade"] : NULL;

            $retorno = new stdClass;
            $retorno->erro = FALSE;
            $retorno->msg = NULL;

            $this->dbConexao->conexao();

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

    public function todos()
    {
        try {
            $this->dbConexao->conexao();

            $sql = "SELECT * FROM pessoas";

            $stmt = $this->dbConexao->pdo->query($sql);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return [];
        }
    }
}