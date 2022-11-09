<?php

    session_start();

    require_once 'db_connect.php';

    if(isset($_POST['username'], $_POST['login'], $_POST['password'], $_POST['email'], $_POST['profile'])){
        $username = mysqli_escape_string($connect, $_POST['username']);
        $login = mysqli_escape_string($connect, $_POST['login']);
        $password = mysqli_escape_string($connect, $_POST['password']);
        $email = mysqli_escape_string($connect, $_POST['email']);
        $profile = mysqli_escape_string($connect, $_POST['profile']);
        $id = mysqli_escape_string($connect, $_POST['id']);

        $sql = "UPDATE usuarios SET username = '$username', login = '$login', password = '$password', email = '$email', profile = '$profile' WHERE id = '$id'";

        if(mysqli_query($connect, $sql)){
            $_SESSION['mensagem'] = "<div class='alert alert-success'>Atualizado com sucesso!</div>";
            header('Location: ../pages/users-list.php');
        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger'>Erro ao atualizar!</div>";
            header('Location: ../pages/users-list.php');
        }
    
    }
