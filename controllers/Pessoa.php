<?php

namespace controllers;

include_once("./models/Pessoa.php");

use models\Pessoa as modelPessoa;

class Pessoa
{
    public static $pessoaModel;

    public static function editar($dados)
    {
        self::$pessoaModel = new modelPessoa();

        if (!$dados) {
            return  print_r(json_encode(["erro" => TRUE, "msg" => "Dados não informados"]));
        }

        $nome = isset($dados["nome"]) ? $dados["nome"] : NULL;
        $idade = isset($dados["idade"]) ? filter_var($dados["idade"], FILTER_SANITIZE_NUMBER_INT) : NULL;

        if (!$nome || !$idade) {
            if (!is_numeric($idade)) {
                return print_r(json_encode(["erro" => TRUE, "msg" => "Idade deve ser um numero"]));
            }
            return print_r(json_encode(["erro" => TRUE, "msg" => "Campos obrigatórios"]));
        }

        $cadastrar = self::$pessoaModel->cadastrar($dados);

        if ($cadastrar->erro) {
            return print_r(json_encode(["erro" => TRUE, "msg" => $cadastrar->msg]));
        }

        return print_r(json_encode(["erro" => FALSE, "msg" => "Pessoa cadastrada com sucesso"]));
    }

    public static function cadastrar($dados)
    {
        self::$pessoaModel = new modelPessoa();

        if (!$dados) {
            return  print_r(json_encode(["erro" => TRUE, "msg" => "Dados não informados"]));
        }

        $nome = isset($dados["nome"]) ? $dados["nome"] : NULL;
        $idade = isset($dados["idade"]) ? filter_var($dados["idade"], FILTER_SANITIZE_NUMBER_INT) : NULL;

        if (!$nome || !$idade) {
            if (!is_numeric($idade)) {
                return print_r(json_encode(["erro" => TRUE, "msg" => "Idade deve ser um numero"]));
            }
            return print_r(json_encode(["erro" => TRUE, "msg" => "Campos obrigatórios"]));
        }

        $cadastrar = self::$pessoaModel->cadastrar($dados);

        if ($cadastrar->erro) {
            return print_r(json_encode(["erro" => TRUE, "msg" => $cadastrar->msg]));
        }

        return print_r(json_encode(["erro" => FALSE, "msg" => "Pessoa cadastrada com sucesso"]));
    }

    public static function todos()
    {
        self::$pessoaModel = new modelPessoa();

        return self::$pessoaModel->todos();
    }
}