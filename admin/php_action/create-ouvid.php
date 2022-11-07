<?php

    session_start();

    require_once 'db_connect.php';


    if(isset($_POST['company'], $_POST['department'], $_POST['name'], $_POST['phone'], $_POST['email'], $_POST['sector'], $_POST['notification'], $_POST['report'])){
        $company = mysqli_escape_string($connect, $_POST['company']);
        $department = mysqli_escape_string($connect, $_POST['department']);
        $name = mysqli_escape_string($connect, $_POST['name']);
        $phone = mysqli_escape_string($connect, $_POST['phone']);
        $email = mysqli_escape_string($connect, $_POST['email']);
        $sector = mysqli_escape_string($connect, $_POST['sector']);
        $notification = mysqli_escape_string($connect, $_POST['notification']);
        $report = mysqli_escape_string($connect, $_POST['report']);

        $sql = "INSERT INTO ombudsman (company, department, name, phone, email, sector, notification, report) VALUES ('$company', '$department', '$name', '$phone', '$email', '$sector', '$notification', '$report')";

        if(mysqli_query($connect, $sql)){
            $_SESSION['mensagem'] = "<div class='alert alert-success'>Ação executada com sucesso!</div>";
            header('Location: ../pages/ouvid-list.php');
        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger'>Ação não executada</div>";
            header('Location: ../pages/ouvid-list.php');
        }
    }