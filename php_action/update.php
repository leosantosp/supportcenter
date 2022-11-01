<?php

    session_start();

    require_once 'db_connect.php';

if(isset($_POST['nome'],$_POST['department'],$_POST['email'],$_POST['phone'],$_POST['unity'],$_POST['birth'])){
    $nome = mysqli_escape_string($connect, $_POST['nome']);
    $department = mysqli_escape_string($connect, $_POST['department']);
    $email = mysqli_escape_string($connect, $_POST['email']);
    $phone = mysqli_escape_string($connect, $_POST['phone']);
    $unity = mysqli_escape_string($connect, $_POST['unity']);
    $birth = mysqli_escape_string($connect, $_POST['birth']);
    $id = mysqli_escape_string($connect, $_POST['id']);

    $sql = "UPDATE colaboradores SET fullname = '$nome', department = '$department', email = '$email', phone = '$phone', unity = '$unity', birth = '$birth' WHERE id = '$id'";

    if(mysqli_query($connect, $sql)){
        $_SESSION['mensagem'] = "<div class='alert alert-success'>Atualizado com sucesso!</div>" ;
        header("Location: ../index.php");
    } else{
        $_SESSION['mensagem'] = "<div class='alert alert-danger'>Erro ao atualizar!</div>";
        header("Location: ../index.php");
    }

}