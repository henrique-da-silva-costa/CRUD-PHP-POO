<?php

use controllers\Pessoa;

include_once("./controllers/Pessoa.php");

$pessoa = new Pessoa();

$pessoa->cadastrar($_REQUEST);