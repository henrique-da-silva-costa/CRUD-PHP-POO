<?php

use controllers\Pessoa;

include_once("./controllers/Pessoa.php");

$pessoa = new Pessoa();

$pessoa->editar($_REQUEST);