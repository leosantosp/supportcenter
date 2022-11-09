<?php 

    session_start();

    require_once 'db_connect.php';

    if(isset($_POST['status'], $_POST['description'], $_POST['solution'])){
        $id = mysqli_escape_string($connect, $_POST['id']);
        $status = mysqli_escape_string($connect, $_POST['status']);
        $description = mysqli_escape_string($connect, $_POST['description']);
        $solution = mysqli_escape_string($connect, $_POST['solution']); 


        $sql = "UPDATE errors SET status = '$status', description = '$description', solution = '$solution' WHERE id = '$id'";

        if(mysqli_query($connect, $sql)){
            $_SESSION['mensagem'] = "<div class='alert alert-success'>Atualizado com sucesso!</div>";
            header('Location: ../pages/errors-list.php');
        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger'>Erro ao atualizar!</div>";
            header('Location: ../pages/errors-list.php');
        }
    }