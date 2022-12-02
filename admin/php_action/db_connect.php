<?php

/**
 * Realizando a conexão com o banco de dados
 * Definindo as variáveis de acesso
 */

$servername = "localhost"; // Nome do servidor
$username = "root"; // Usuário do servidor
$password = "500500500Ti"; // Senha do servidor
$dbname = "supportcenter"; // Nome do Banco de Dados

/**
 * Programação Procedural funciona apenas em MYSQLI
 * Programação Orientada a Objeto (PDO) funciona em todos os tipos de bancos 
 * Definido as variáveis, é necessário criar uma variável de conexão, onde os dados 
 * do banco de dados serão inseridos
 * 
 * $variavelConexao = mysqli_connect($nomedoServer, $usuario, $senha, $nomeDoBanco);
 * mysqli_set_charset($variavelConexao, "utf-8") -> serve para o banco interpretar formatação utf-8
 */

 $connect = mysqli_connect($servername, $username, $password, $dbname);
 mysqli_set_charset($connect, "UTF8");

 /**
  * Definindo um retorno caso dê algum erro de conexão e retornar ao usuário utilizando
  * a função mysqli_connect_error() que retorna erros que aconteceram no banco
  */

  if(mysqli_connect_error()) : echo "Erro na Conexão: ".mysqli_connect_error();
  endif;
