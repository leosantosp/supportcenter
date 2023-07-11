<?php

    session_start();

    require_once 'db_connect.php';

    if(isset($_POST['username'], $_POST['login'], $_POST['password'], $_POST['email'], $_POST['profile'], $_POST['permission'])){
        $username = mysqli_escape_string($connect, $_POST['username']);
        $login = mysqli_escape_string($connect, $_POST['login']);
        $password = mysqli_escape_string($connect, $_POST['password']);
        $permission = mysqli_escape_string($connect, $_POST['permission']);
        $password_conv = md5($password);
        $email = mysqli_escape_string($connect, $_POST['email']);
        $profile = mysqli_escape_string($connect, $_POST['profile']);
        $id = mysqli_escape_string($connect, $_POST['id']);

        $sql = "UPDATE usuarios SET username = '$username', login = '$login', password = '$password_conv', email = '$email', profile = '$profile', permission = '$permission' WHERE id = '$id'";

        if(mysqli_query($connect, $sql)){
            $_SESSION['mensagem'] = "<div class='alert alert-success'>Atualizado com sucesso!</div>";
            header('Location: ../pages/users-list.php');
        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger'>Erro ao atualizar!</div>";
            header('Location: ../pages/users-list.php');
        }
    
    }
