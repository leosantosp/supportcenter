<?php

    session_start();

    require_once 'db_connect.php';

    if(isset($_POST['btn-delete'])){
        $id = mysqli_escape_string($connect, $_POST['id']);

        $sql = "DELETE FROM catalogoenderecos WHERE id = '$id'";

        if(mysqli_query($connect, $sql)){
            $_SESSION['mensagem'] = "<div class='alert alert-success'>Deletado com sucesso!</div>";
            header("Location: ../pages/catend-list.php");
        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger'>Erro ao deletar!</div>";
            header('Location: ../pages/catend-list.php');
        }
    }