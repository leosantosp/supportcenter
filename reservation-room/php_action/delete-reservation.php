<?php

    session_start();

    include_once 'db_connect.php';

    if(!isset($_SESSION['logado'])):
        header('Location: index.php');
    endif;

    /* Captura dados da sessão */

    $idsessao = $_SESSION['id_usuario'];
    $sqllogado = "SELECT * FROM usuarios WHERE id = '$idsessao'";
    $resultadologado = mysqli_query($connect, $sqllogado);
    $dadoslogado = mysqli_fetch_array($resultadologado);

    $verified = $idsessao;
    $id = mysqli_escape_string($connect, $_GET['id']);
    $hostid = mysqli_escape_string($connect, $_GET['hostid']);

    if($verified == $hostid AND !empty($id)){
        $sql = "DELETE FROM reservations WHERE id = '$id'";

        if($resultado = mysqli_query($connect, $sql)){
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>SUA RESERVA FOI EXCLUÍDA!</div>";
            header('Location: ../home.php');
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>ERRO: NÃO FOI POSSÍVEL REALIZAR A EXCLUSÃO</div>";
            header('Location: ../home.php');
        }

    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>ERRO: VOCÊ TENTOU EXCLUIR UMA RESERVA QUE NÃO ERA SUA!</div>";
        header('Location: ../home.php');
    }