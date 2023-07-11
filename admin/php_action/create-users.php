<?php

    session_start();

    require_once 'db_connect.php';

    if(isset($_POST['username'], $_POST['login'], $_POST['email'], $_POST['password'], $_POST['profile'], $_POST['permission'])){
        $username = mysqli_escape_string($connect, $_POST['username']);
        $login = mysqli_escape_string($connect, $_POST['login']);
        $email = mysqli_escape_string($connect, $_POST['email']);
        $password = mysqli_escape_string($connect, $_POST['password']);
        $profile = mysqli_escape_string($connect, $_POST['profile']);
        $permission = mysqli_escape_string($connect, $_POST['permission']);
        $password = md5($password);
    
        $sql = "INSERT INTO usuarios (username, login, email, password, profile, permission) VALUES ('$username', '$login', '$email', '$password', '$profile', '$permission')";

        if(mysqli_query($connect, $sql)){
            $_SESSION['mensagem'] = "<div class='alert alert-success'>Ação executada com sucesso!</div>";
            header('Location: ../pages/users-list.php');
        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger'>Ação não executada</div>";
            header('Location: ../pages/users-list.php');
        }
    
    }
