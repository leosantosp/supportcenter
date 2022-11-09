<?php 

    session_start();

    require_once 'db_connect.php';

    if(isset($_POST['status'], $_POST['description'], $_POST['solution'])){
        $status = mysqli_escape_string($connect, $_POST['status']);
        $description = mysqli_escape_string($connect, $_POST['description']);
        $solution = mysqli_escape_string($connect, $_POST['solution']);

        $sql = "INSERT INTO errors (status, description, solution) VALUES ('$status', '$description', '$solution')";

        if(mysqli_query($connect, $sql)){
            $_SESSION['mensagem'] = "<div class='alert alert-success'>Ação executada com sucesso!</div>";
            header('Location: ../pages/errors-list.php');
        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger'>Ação não executada</div>";
            header('Location: ../pages/errors-list.php');
        }
    }