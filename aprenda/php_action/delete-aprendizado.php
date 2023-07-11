<?php

    session_start();

    require_once 'db_connect.php';

    if(isset($_POST['btn-delete'])){
        $id = mysqli_escape_string($connect, $_POST['id']);
        $permission = mysqli_escape_string($connect, $_POST['permission']);

        if($permission !== 1){
            $_SESSION['mensagem'] = "<div class='alert alert-danger'>Erro ao deletar! Você não possui permissão para deleter aprendizados</div>";
            header('Location: ../pages/list-aprendizado.php');
        }

        $sql = "DELETE FROM tutoriais WHERE id = '$id'";

        if(mysqli_query($connect, $sql)){
            $_SESSION['mensagem'] = "<div class='alert alert-success'>Deletado com sucesso!</div>";
            header('Location: ../pages/list-aprendizado.php');
        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger'>Erro ao deletar!</div>";
            header('Location: ../pages/list-aprendizado.php');
        }
    }