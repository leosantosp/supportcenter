<?php 

    session_start();

    require_once 'db_connect.php';

    if(isset($_POST['btn-update'])){
        $id = mysqli_escape_string($connect, $_POST['id']);
        $username = mysqli_escape_string($connect, $_POST['username']);
        $login = mysqli_escape_string($connect, $_POST['login']);
        $password = mysqli_escape_string($connect, $_POST['password']);
        $password_conv = md5($password);
        $email = mysqli_escape_string($connect, $_POST['email']);
        $department = mysqli_escape_string($connect, $_POST['department']);
        $estabelecimento = mysqli_escape_string($connect, $_POST['estabelecimento']);
        $pc = mysqli_escape_string($connect, $_POST['pc']);
        $ramal = mysqli_escape_string($connect, $_POST['ramal']);

        $sql = "UPDATE usuarios SET username = '$username', login = '$login', password = '$password_conv', pc= '$pc', ramal='$ramal', email = '$email', department = '$department', estabelecimento = '$estabelecimento' WHERE id = '$id'";

        if(mysqli_query($connect, $sql)){
            $_SESSION['mensagem'] = "<div class='toast show top-0 end-0 text-bg-success border-0 ' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='150' data-bs-autohide='true'>
            <div class='d-flex'>
              <div class='toast-body'>
                Usuário atualizado
              </div>
              <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
            </div>
          </div>";
            header('Location: ../pages/alterar-dados.php');
        } else {
            $_SESSION['mensagem'] = "<div class='toast show top-0 end-0 text-bg-danger border-0 ' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='150' data-bs-autohide='true'>
            <div class='d-flex'>
              <div class='toast-body'>
                Não foi possível atualizar. Tente novamente mais tarde
              </div>
              <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
            </div>
          </div>";
            header('Location: ../pages/alterar-dados.php');
        }

    }