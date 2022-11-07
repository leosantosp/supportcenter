<?php 
session_start(); // Session start


// Limpar o buffer
ob_start();

include_once('../admin/php_action/db_connect.php');


$query_usuarios = "SELECT tratamento, empresa, cargo, email FROM catalogoenderecos ORDER BY id DESC";
$result_usuarios = mysqli_query($connect, $query_usuarios);

// Aceitar csv ou texto
header('Content-Type: text/csv; charset=UTF-8');

// Nome do arquivo
header('Content-Disposition: attachment; filename=catalogo-de-enderecos.csv');

// Gravar no Buffer
$resultado = fopen("php://output", 'w');

// Criar cabeçalho do Excel - Usar função mb_convert_encoding para converter caracteres especiais
$cabecalho = ['Tratamento', 'Empresa', 'Cargo', "E-mail Address"];

// Escrever no arquivo
fputcsv($resultado, $cabecalho, ',');

while($row_usuario = mysqli_fetch_assoc($result_usuarios)){

    // Escrever conteúdo
    fputcsv($resultado, $row_usuario, ',');
}



// Fechar o arquivo
fclose($resultado);

$_SESSION['msg'] = "<p>Nenhum usuário encontrado</p>";