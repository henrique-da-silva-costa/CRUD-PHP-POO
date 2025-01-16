<?php

use controllers\Pessoa;

include_once("./controllers/Pessoa.php");

$pessoa = new Pessoa();

print_r(json_encode($pessoa->pegarProId()));