<?php

    session_start(); // Iniciando a sessão

    require_once 'db_connect.php'; // Faça conexão com o banco

    if(isset($_POST['tratamento'], $_POST['cargo'], $_POST['empresa'], $_POST['email'], $_POST['senha'])){
        
        $tratamento = mysqli_escape_string($connect, $_POST['tratamento']);
        $cargo = mysqli_escape_string($connect, $_POST['cargo']);
        $empresa = mysqli_escape_string($connect, $_POST['empresa']);
        $email = mysqli_escape_string($connect, $_POST['email']);
        $senha = mysqli_escape_string($connect, $_POST['senha']);

        $sql = "INSERT INTO catalogoenderecos (tratamento, empresa, cargo, email, senha) VALUES ('$tratamento', '$cargo', '$empresa', '$email', '$senha')";
        
        if(mysqli_query($connect, $sql)){
            $_SESSION['mensagem'] = "<div class='alert alert-success'>Ação executada com sucesso!</div>";
            header('Location: ../pages/catend-list.php');
        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger'>Ação não executada</div>";
            header('Location: ../pages/catend-list.php');
        }
    }

