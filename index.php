<?php

use controllers\Pessoa;

include_once("./controllers/Pessoa.php");

echo json_encode(Pessoa::todos());