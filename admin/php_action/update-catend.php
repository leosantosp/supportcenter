<?php

    session_start();

    require_once 'db_connect.php';

    if(isset($_POST['tratamento'], $_POST['empresa'], $_POST['senha'], $_POST['cargo'], $_POST['email'])){
        $tratamento = mysqli_escape_string($connect, $_POST['tratamento']);
        $empresa = mysqli_escape_string($connect, $_POST['empresa']);
        $cargo = mysqli_escape_string($connect, $_POST['empresa']);
        $email = mysqli_escape_string($connect, $_POST['email']);
        $senha = mysqli_escape_string($connect, $_POST['senha']);

        $sql = "UPDATE catalogoenderecos SET tratamento = '$tratamento', empresa = '$empresa', cargo = '$cargo', email = '$email', senha = '$senha'";

        if(mysqli_query($connect, $sql)){
            $_SESSION['mensagem'] = "<div class='alert alert-success'>Atualizado com sucesso!</div>";
            header('Location: ../pages/catend-list.php');
        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger'>Erro ao atualizar!</div>";
            header("Location: ../pages/catend-list.php");
        }
    }