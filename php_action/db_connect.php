<?php 

// Conexão com o Banco de Dados

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "centralsuporte";

// MYSQLI é uma evolução do MYSQL, ele tem suporte a programação procedural -> Tem suporte apenas ao MYSQL
// PDO é uma programação orientada a objetos -> Tem suporte para outras linguagens
$connect = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($connect, "utf8");

// Se houver um erro na conexão. Retorne o erro.
if(mysqli_connect_error()) : echo "Erro na conexão: ".mysqli_connect_error();
endif;