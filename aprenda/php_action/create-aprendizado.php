<?php 

    session_start();

    require_once 'db_connect.php';


    if(isset($_POST['submit-form'], $_POST['title'], $_POST['description'], $_POST['class'], $_POST['permission'])){
    
        $titulo = mysqli_escape_string($connect, $_POST['title']);
        $descricao = mysqli_escape_string($connect, $_POST['description']);
        $class = mysqli_escape_string($connect, $_POST['class']);
        $permission = mysqli_escape_string($connect, $_POST['permission']);
        

        $formatosPermitidos = array("pdf", "docx", "xlsx", "csv", "xlsb", "xls", "txt", "rtf", "doc", "docm", "mp4");
        $quantidadeArquivos = count($_FILES['files']['name']);
        $contador = 0;
        $fileNames = "";

        if($permission !== 1){
            $_SESSION['mensagem'] = "<div class='alert alert-danger'>Ação não executada! Você não possui permissão para criar aprendizado</div>";
            header('Location: ../pages/list-aprendizado.php');
        }

        while($contador < $quantidadeArquivos){

            $extensao = pathinfo($_FILES['files']['name'][$contador], PATHINFO_EXTENSION);

            if(in_array($extensao, $formatosPermitidos)){
                $pasta = "../aprenda/$class/";
                $temporario = $_FILES['files']['tmp_name'][$contador];
                $novoNome = $_FILES['files']['name'][$contador];

                $files = [];
                array_push($files, $novoNome);

                if(move_uploaded_file($temporario, $pasta.$novoNome)){
                    echo "Upload feito com sucesso para $pasta.$novoNome <br>!";
                } else {
                    echo "Erro, não foi possível fazer o upload de $temporario!";
                }

                $fileNames = $fileNames.$novoNome.";";


            } else {
                $mensagem = "$extensao não é um formato inválido!";
            }

            $contador++;

        }


        $sql = "INSERT INTO tutoriais (class, title, description, file) VALUES ('$class', '$titulo', '$descricao', '$fileNames')";
        
        if(mysqli_query($connect, $sql)){
            $_SESSION['mensagem'] = "<div class='alert alert-success'>Ação executada com sucesso!</div>";
            header('Location: ../pages/list-aprendizado.php');
        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger'>Ação não executada</div>";
            header('Location: ../pages/list-aprendizado.php');
        }

    }

?>