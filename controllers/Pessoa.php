<?php

namespace controllers;

include_once("./models/Pessoa.php");

use models\Pessoa as modelPessoa;

class Pessoa
{
    public $pessoaModel;

    public function __construct()
    {
        $this->pessoaModel = new modelPessoa();
    }

    public function todos()
    {
        return $this->pessoaModel->todos();
    }

    public function pegarProId()
    {
        return $this->pessoaModel->pegarPorId();
    }

    public function cadastrar($dados)
    {
        if (!$dados) {
            return  print_r(json_encode(["erro" => TRUE, "msg" => "Dados não informados"]));
        }

        $idade = isset($dados["idade"]) ? $dados["idade"] : NULL;

        foreach ($dados as $valor) {
            if (!$valor) {
                return print_r(json_encode(["erro" => TRUE]));
            }

            if (strlen($valor) > 10) {
                return print_r(json_encode(["erro" => TRUE]));
            }

            if (strlen($valor) > 255) {
                return print_r(json_encode(["erro" => TRUE]));
            }
        }

        $existe = $this->pessoaModel->existe($dados);

        if ($existe) {
            return print_r(json_encode(["erro" => TRUE, "msg" => "Essa pessoa já exsite"]));
        }

        if (strlen($idade) > 0 && !is_numeric($idade)) {
            return print_r(json_encode(["erro" => TRUE, "msg" => "Idade deve ser um numero"]));
        }

        $cadastrar = $this->pessoaModel->cadastrar($dados);

        if ($cadastrar->erro) {
            return print_r(json_encode(["erro" => TRUE, "msg" => $cadastrar->msg]));
        }

        return print_r(json_encode(["erro" => FALSE, "msg" => "Pessoa cadastrada com sucesso"]));
    }

    public function editar($dados)
    {
        if (!$dados) {
            return  print_r(json_encode(["erro" => TRUE, "msg" => "Dados não informados"]));
        }

        $id = isset($dados["id"]) ? $dados["id"] : NULL;
        $idade = isset($dados["idade"]) ? ($dados["idade"]) : NULL;

        if (!is_numeric($id)) {
            return print_r(json_encode(["erro" => TRUE, "msg" => "Psessoa não existe"]));
        }

        foreach ($dados as $valor) {
            if (!$valor) {
                return print_r(json_encode(["erro" => TRUE]));
            }

            if (strlen($valor) > 255) {
                return print_r(json_encode(["erro" => TRUE]));
            }
        }

        $existe = $this->pessoaModel->existe($dados);

        if ($existe) {
            return print_r(json_encode(["erro" => TRUE, "msg" => "Essa pessoa já exsite"]));
        }

        if (strlen($idade) > 0 && !is_numeric($idade)) {
            return print_r(json_encode(["erro" => TRUE, "msg" => "Idade deve ser um numero"]));
        }

        $editar = $this->pessoaModel->editar($dados);

        if ($editar->erro) {
            return print_r(json_encode(["erro" => TRUE, "msg" => $editar->msg]));
        }

        return print_r(json_encode(["erro" => FALSE, "msg" => "Pessoa editada com sucesso"]));
    }

    public function excluir($dados)
    {
        $id = isset($dados["id"]) ? $dados["id"] : NULL;

        if (!is_numeric($id)) {
            return print_r(json_encode(["erro" => TRUE, "msg" => "Pessoa não existe"]));
        }

        $excluir = $this->pessoaModel->excluir($id);

        if ($excluir->erro) {
            return print_r(json_encode(["erro" => TRUE, "msg" => $excluir->erro]));
        }

        return print_r(json_encode(["erro" => FALSE, "msg" => NULL]));
    }
}