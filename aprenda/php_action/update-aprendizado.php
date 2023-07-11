<?php 

    session_start();

    require_once 'db_connect.php';

    if(isset($_POST['title'], $_POST['description'], $_POST['class'], $_POST['permission'])){
        $id = mysqli_escape_string($connect, $_POST['id']);
        $title = mysqli_escape_string($connect, $_POST['title']);
        $description = mysqli_escape_string($connect, $_POST['description']);
        $class = mysqli_escape_string($connect, $_POST['class']);
        $permission = mysqli_escape_string($connect, $_POST['permission']);

        $allowedFormats = array("pdf", "docx", "xlsx", "csv", "xlsb", "xls", "txt", "rtf", "doc", "docm", "mp4");
        $amountFiles = count($_FILES['files']['name']);
        $count = 0;
        $fileNames = "";

        if($permission !== 1){
            $_SESSION['mensagem'] = "<div class='alert alert-danger'> Ação não executada! Você não possui permissão para criar aprendizados</div>";
            header('Location: ../pages/list-aprendizado.php');
        }

        while($count < $amountFiles){

            $extension = pathinfo($_FILES['files']['name'][$count], PATHINFO_EXTENSION);

            if(in_array($extension, $allowedFormats)){
                $folder = "../aprenda/$class/";
                $temporary = $_FILES['files']['tmp_name'][$count];
                $newName = $_FILES['files']['name'][$count];

                $files = [];
                array_push($files, $newName);

                if(move_uploaded_file($temporary, $folder.$newName)){
                    echo "Upload feito com sucesso para $folder.$newName <br>!";
                } else {
                    echo "Erro: Não foi possível fazer o upload de $temporary";
                }

                $fileNames = $fileNames.$newName.";";

            } else {
                $mensagem = "$extension não é um formato válido!";
            }

            $count++;

        }

        $sql = "UPDATE tutoriais SET title = '$title', description = '$description', class = '$class', file = '$fileNames' WHERE id = '$id'";

        if(mysqli_query($connect, $sql)){
            $_SESSION['mensagem'] = "<div class='alert alert-success'> Atualizado com sucesso! </div>";
            header('Location: ../pages/list-aprendizado.php');
        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger'>Erro ao atualizar!</div>";
            header('Location: ../pages/list-aprendizado.php');
        }
    }