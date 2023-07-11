<?php
    date_default_timezone_set('America/Sao_Paulo');
    
    $date = date('Y-m-d H:i');
    /**
     * Iniciando a sessão
     */

    session_start();

    /**
     * Conectando no banco de dados
     */
    require_once 'db_connect.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';

    header('Content-Type: text/html; charset=utf-8');

    if(isset($_POST['btn-create'])){
        $cardid = mysqli_escape_string($connect, $_POST['cardid']);
        $aplicativo = mysqli_escape_string($connect, $_POST['aplicativo']);
        $assunto = mysqli_escape_string($connect, $_POST['assunto']);
        $descricao = mysqli_escape_string($connect, $_POST['description']);
        $nivel = mysqli_escape_string($connect, $_POST['nivel']);
        $userid = mysqli_escape_string($connect, $_POST['userid']);

        $consultSQL = "SELECT * FROM chamados_sil WHERE card_id = $cardid";
        $executeConsult = mysqli_query($connect, $consultSQL);
        if(mysqli_num_rows($executeConsult) > 0){
            $_SESSION['mensagem'] = "<div class='alert alert-warning'>Chamado SIL já está cadastrado em sistema</div>";
            header('Location: ../pages/sil-chamados.php');
        } else {
            $status = 'Em triagem';

            $sqlInsert = "INSERT INTO chamados_sil (card_id, username_id, aplicativo, assunto, descricao, nivel, status, abertura) VALUES ('$cardid', '$userid', '$aplicativo', '$assunto', '$descricao', '$nivel', '$status', '$date')";

            if(mysqli_query($connect, $sqlInsert)){
                $_SESSION['mensagem'] = "<div class='toast show top-0 end-0 text-bg-success border-0 ' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='150' data-bs-autohide='true'>
                <div class='d-flex'>
                  <div class='toast-body'>
                    Chamado SIL aberto com sucesso!
                  </div>
                  <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
                </div>
              </div>";
                header('Location: ../pages/sil-chamados.php');
            } else {
                $_SESSION['mensagem'] = "<div class='toast show top-0 end-0 text-bg-danger border-0 ' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='150' data-bs-autohide='true'>
                <div class='d-flex'>
                  <div class='toast-body'>
                    Não foi possível criar um chamado SIL. Tente novamente mais tarde
                  </div>
                  <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
                </div>
              </div>";
                header('Location: ../pages/sil-chamados.php');
            }
        }
    }