<?php 

    session_start();

    require_once 'db_connect.php';

    if(isset($_POST['btn-observations'])){
        $callid = mysqli_escape_string($connect, $_POST['callid']);
        $observations = mysqli_escape_string($connect, $_POST['observations']);

        $updateObs = "UPDATE chamados SET observations='$observations' WHERE id = '$callid'";

        if(mysqli_query($connect, $updateObs)){
            $_SESSION['mensagem'] = "<div class='toast show top-0 end-0 text-bg-success border-0 ' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='150' data-bs-autohide='true'>
            <div class='d-flex'>
              <div class='toast-body'>
                Observações inseridas com sucesso!
              </div>
              <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
            </div>
          </div>";
            header('Location: ../pages/meus-chamados.php');
        } else {
            $_SESSION['mensagem'] = "<div class='toast show top-0 end-0 text-bg-danger border-0 ' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='150' data-bs-autohide='true'>
            <div class='d-flex'>
              <div class='toast-body'>
                Não foi possível inserir uma observação. Tente novamente mais tarde!
              </div>
              <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
            </div>
          </div>";
            header('Location: ../pages/meus-chamados.php');
        }
    }