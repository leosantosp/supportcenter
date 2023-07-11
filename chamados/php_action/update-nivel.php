<?php 

    session_start();

    require_once 'db_connect.php';

    if(isset($_POST['updateNivel'])){
        $callid = mysqli_escape_string($connect, $_POST['callid']);
        $nivel = mysqli_escape_string($connect, $_POST['nivel']);

        $updateNivel = "UPDATE chamados SET nivel='$nivel' WHERE id = '$callid'";

        if(mysqli_query($connect, $updateNivel)){
            $_SESSION['mensagem'] = "<div class='toast show top-0 end-0 text-bg-success border-0 ' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='150' data-bs-autohide='true'>
            <div class='d-flex'>
              <div class='toast-body'>
                Nível de prioridade atribuído com sucesso!
              </div>
              <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
            </div>
          </div>";
            header('Location: ../pages/meus-chamados.php');
        } else {
            $_SESSION['mensagem'] = "<div class='toast show top-0 end-0 text-bg-danger border-0 ' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='150' data-bs-autohide='true'>
            <div class='d-flex'>
              <div class='toast-body'>
                Não foi possível atribuir um nível de prioridade! Tente novamente mais tarde.
              </div>
              <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
            </div>
          </div>";
            header('Location: ../pages/meus-chamados.php');
        }
    }