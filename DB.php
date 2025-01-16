<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST ,DELETE');
header("Access-Control-Allow-Headers: X-Requested-With");

class Banco
{

    public $host;
    public $nomeBanco;
    public $usuarioNome;
    public $senha;
    public $pdo;

    public function __construct()
    {
        $this->host = "localhost";
        $this->nomeBanco = "php_poo";
        $this->usuarioNome = "root";
        $this->senha = "";
    }

    public function conexao()
    {
        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->nomeBanco};charset=utf8", $this->usuarioNome, $this->senha);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\Throwable $th) {
            echo "Erro ao conectar com o banco de dados: " . $th->getMessage();
        }
    }
}