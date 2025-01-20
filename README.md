# Projeto Crud com PHP -BACK-END

# Para iniciar o projeto.

Tenha a versao 8 do PHP instalado em suda maquina, em seguida rode o comando php -S localhost:1999

Após isso, rode o Front-end -> https://github.com/henrique-da-silva-costa/FRONT-CRUD-PHP-POO

## Descrição.

Esse é um projeto simples que faz um crud usando POO(Programação orientada a objeto), em uma unica página.

Ele cria, edita, lista e exclui a pessoa e tambem tme um filtro por nome.

## Controllers

Exsite a classe Pessoa com metodos e atributos publicos

### atributo.

* pessoaModel -> chama a classe Pessoa da pasta models

### metodos

* todos -> Lista todas as pessoas, podendo filtrar por nome.

* pegarPorID -> Lista a pessoa pelo paramentro(id)

* Cadastrar -> Cadastra uma pessoa e faz validações.

* Editar -> edita uma pessoa e faz validações.

* Excluir -> exclui uma pessoa e faz validações.

## Models

Exsite a classe Pessoa com metodos e atributos publicos

### atributo.

* dbConexao -> faz a cconexao com o banco de dados.

### metodos

* todos -> Lista todas as pessoas, podendo filtrar por nome.

* pegarPorID -> Lista a pessoa pelo paramentro(id)

* Cadastrar -> Cadastrar uma pessoa.

* Editar -> edita uma pessoa.

* Excluir -> exclui uma pessoa.

* Existe -> verifica se existe uma pessoa com o mesmo nome e idade.

## Rotas.

Foi feito de uma forma muito simples.

* Cadastrar -> /cadastrar.php

* Listar -> /index.php

* Editar -> /editar.php

* Excluir -> /excluir.php


