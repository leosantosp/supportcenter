<?php

    session_start();

    require_once 'db_connect.php';

    if(isset($_POST['compnumber'], $_POST['compname'], $_POST['cnpj'], $_POST['phone'], $_POST['address'], $_POST['manager'], $_POST['ie'])){
        $compnumber = mysqli_escape_string($connect, $_POST['compnumber']);
        $compname = mysqli_escape_string($connect, $_POST['compname']);
        $cnpj = mysqli_escape_string($connect, $_POST['cnpj']);
        $phone = mysqli_escape_string($connect, $_POST['phone']);
        $address = mysqli_escape_string($connect, $_POST['address']);
        $manager = mysqli_escape_string($connect, $_POST['manager']);
        $ie = mysqli_escape_string($connect, $_POST['ie']);
        $id = mysqli_escape_string($connect, $_POST['id']);

        $sql = "UPDATE companys SET compnumber = '$compnumber', compname = '$compname', cnpj = '$cnpj', phone = '$phone', address = '$address', manager = '$manager', ie = '$ie' WHERE id = '$id'";

        if(mysqli_query($connect, $sql)){
            $_SESSION['mensagem'] = "<div class='alert alert-success'>Atualizado com sucesso!</div>" ;
            header("Location: ../pages/company-list.php");
        } else{
            $_SESSION['mensagem'] = "<div class='alert alert-danger'>Erro ao atualizar!</div>";
            header("Location: ../pages/company-list.php");
        }
    }