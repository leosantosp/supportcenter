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

    mysqli_close($connect);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin | Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body id="admin-panel">

    <h1>Bem vindo(a), <?php echo $dados['username']; ?>!</h1>
    <p>Este é o módulo de Reserva de Sala de Reuniões, utilize o calendário abaixo para agendar uma reunião</p>

    <nav class="admin-nav">
        <ul class="admin-nav-list">
            <li class="admin-nav-item"><a href="pages/users-list.php">Usuários</a></li>
            <li class="admin-nav-item"><a href="pages/colab-list.php">Colaboradores</a></li>
            <li class="admin-nav-item"><a href="pages/catend-list.php">Catálogo de Endereços</a></li>
            <li class="admin-nav-item"><a href="#">Reserva de Salas</a></li>
            <li class="admin-nav-item"><a href="pages/company-list.php">Unidades</a></li>
            <li class="admin-nav-item"><a href="pages/tutorials-list.php">Tutoriais</a></li>
            <li class="admin-nav-item"><a href="pages/errors-list.php">Erros do Sintra</a></li>
            <li class="admin-nav-item"><a href="pages/ouvid-list.php">Ouvidoria</a></li>
            <li class="admin-nav-item">
                <a href="logout.php">
                    <button class="btn btn-secondary">
                        <img src="assets/images/icon-logout.svg" alt="">
                    </button>
                </a>
            </li>
        </ul>
    </nav>

    

<script src="assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>