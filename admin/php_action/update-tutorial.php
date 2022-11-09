<?php

    session_start();

    require_once 'db_connect.php';

if(isset($_POST['class'], $_POST['title'], $_POST['description'])){
    $id = mysqli_escape_string($connect, $_POST['id']);
    $class = mysqli_escape_string($connect, $_POST['class']);
    $title = mysqli_escape_string($connect, $_POST['title']);
    $description = mysqli_escape_string($connect, $_POST['description']);
    $formatosPermitidos = array("pdf", "mp4", "docx", "xlsx", "csv");
    $extensao = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        
    if(in_array($extensao, $formatosPermitidos)){
        $directory = "../../assets/files/tutoriais/";
        $temporario = $_FILES['file']['tmp_name'];
        $novoNome = uniqid().".$extensao";
        $GLOBALS['newFileName'] = $novoNome;
        move_uploaded_file($temporario, $directory.$novoNome);
    } else {
        $_SESSION['mensagem'] = "<div class='alert alert-danger'>Formatos inválido. Apenas arquivos .PDF, .MP4, .DOCX, .XLSX, .CSV</div>";
        header('Location: ../pages/tutorials-list.php');
    }
    
    $sql = "UPDATE tutoriais SET class = '$class', title = '$title', description = '$description', file = '$newFileName' WHERE id = '$id'";

    if(mysqli_query($connect, $sql)){
        $_SESSION['mensagem'] = "<div class='alert alert-success'>Atualizado com sucesso!</div>" ;
        header("Location: ../pages/tutorials-list.php");
    } else{
        $_SESSION['mensagem'] = "<div class='alert alert-danger'>Erro ao atualizar!</div>";
        header("Location: ../pages/tutorials-list.php");
    }
}