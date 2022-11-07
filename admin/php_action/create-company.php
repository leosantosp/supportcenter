<?php

    session_start();

    require_once 'db_connect.php';


    if(isset($_POST['compnumber'], $_POST['compname'], $_POST['cnpj'], $_POST['phone'], $_POST['address'], $_POST['manager'])){
        $compnumber = mysqli_escape_string($connect, $_POST['compnumber']);
        $compname = mysqli_escape_string($connect, $_POST['compname']);
        $cnpj = mysqli_escape_string($connect, $_POST['cnpj']);
        $phone = mysqli_escape_string($connect, $_POST['phone']);
        $address = mysqli_escape_string($connect, $_POST['address']);
        $manager = mysqli_escape_string($connect, $_POST['manager']);

        $sql = "INSERT INTO companys (compnumber, compname, cnpj, phone, address, manager) VALUES ('$compnumber', '$compname', '$cnpj', '$phone', '$address', '$manager')";

        if(mysqli_query($connect, $sql)){
            $_SESSION['mensagem'] = "<div class='alert alert-success'>Ação executada com sucesso!</div>";
            header('Location: ../pages/company-list.php');
        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger'>Ação não executada</div>";
            header('Location: ../pages/company-list.php');
        }
    }