<?php

    session_start();

    require_once 'db_connect.php';

if(isset($_POST['class'], $_POST['description'], $_POST['title'])){
    $formatosPermitidos = array("pdf", "mp4", "docx", "xlsx", "csv");
    // Trazer extensão do arquivo
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

    $class = mysqli_escape_string($connect, $_POST['class']);
    $title = mysqli_escape_string($connect, $_POST['title']);
    $description = mysqli_escape_string($connect, $_POST['description']);

    $sql = "INSERT INTO tutoriais (class, title, description, file) VALUES ('$class', '$title', '$description', '$newFileName')";

    if(mysqli_query($connect, $sql)){
        $_SESSION['mensagem'] = "<div class='alert alert-success'>Ação executada com sucesso!</div>" ;
        header("Location: ../pages/tutorials-list.php");
    } else{
        $_SESSION['mensagem'] = "<div class='alert alert-danger'>Ação não executada</div>";
        header("Location: ../pages/tutorials-list.php");
    }

}