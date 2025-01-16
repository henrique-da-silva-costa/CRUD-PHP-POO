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

        $nome = isset($dados["nome"]) ? $dados["nome"] : NULL;
        $idade = isset($dados["idade"]) ? $dados["idade"] : NULL;

        if (!is_numeric($idade)) {
            return print_r(json_encode(["erro" => TRUE, "msg" => "Idade deve ser um numero"]));
        }

        if (!$nome || !$idade) {
            return;
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
        $nome = isset($dados["nome"]) ? $dados["nome"] : NULL;
        $idade = isset($dados["idade"]) ? ($dados["idade"]) : NULL;

        if (!is_numeric($id)) {
            return print_r(json_encode(["erro" => TRUE, "msg" => "Psessoa não existe"]));
        }

        if (!is_numeric($idade)) {
            return print_r(json_encode(["erro" => TRUE, "msg" => "Idade deve ser um numero"]));
        }

        if (!$nome || !$idade) {
            return;
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