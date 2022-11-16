<?php

    require_once 'php_action/db_connect.php';

    session_start();

    if(!isset($_SESSION['logado'])):
        header('Location: index.php');
    endif;

    /* Captura dados da sessão */

    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);


?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Reserva de Salas</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="assets/lib/main.min.css" rel="stylesheet">
    <script src="assets/lib/main.min.js"></script>
    <script src="assets/lib/locales-all.min.js"></script>

</head>
<body id="home-admin-panel">
    <input type="checkbox" id="check">
    <header>
        <div class="icon-menu">
            <label for="check">
                <ion-icon name="grid-outline" id="sidebar-btn"></ion-icon>
            </label>
        </div>
    </header>
    <div class="sidebar">
        <div class="center">
            <img class="image" src="assets/images/logo.svg" alt="">
            <h4><?php echo $dados['username'] ?></h4>
        </div>
        <a href="../index.php"><ion-icon name="desktop-outline"></ion-icon><span>Home</span></a> <!-- Home -->
        <a href="../colaborators.php"><ion-icon name="people-outline"></ion-icon> <span>Colaboradores</span>    </a> <!-- Colaboradores -->
        <a href="../companys.php"><ion-icon name="git-branch-outline"></ion-icon> <span>Empresas</span>    </a> <!-- Empresas -->
        <a href="../aprenda.php"><ion-icon name="book-outline"></ion-icon> <span>Aprenda</span>    </a> <!-- Aprenda -->
        <a href="../system-errors.php"><ion-icon name="bug-outline"></ion-icon> <span>Erros</span>    </a> <!-- Erros -->
        <a href="../ouvidoria.php"><ion-icon name="archive-outline"></ion-icon><span>Ouvidoria</span>    </a> <!-- Ouvidoria -->
        <a href="logout.php"><ion-icon name="log-out-outline"></ion-icon> <span>Sair</span>    </a> <!-- Sair -->


    </div>

    <div class="content">

<?php 
    if(isset($_SESSION['mensagem'])){
        echo $_SESSION['mensagem'];
        unset($_SESSION['mensagem']);
    }
?>