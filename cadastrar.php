<?php

use controllers\Pessoa;

include_once("./controllers/Pessoa.php");

Pessoa::cadastrar($_REQUEST);