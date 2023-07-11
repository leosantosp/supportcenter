<?php
    date_default_timezone_set('America/Sao_Paulo');

    $date = date('Y-m-d H:i');

    session_start();

    require_once 'db_connect.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';

    header('Content-Type: text/html; charset=utf-8');

    if(isset($_POST['callFinish'])){
        $callid = mysqli_escape_string($connect, $_POST['idcall']);
        $status = mysqli_escape_string($connect, $_POST['status']);
        $solution = mysqli_escape_string($connect, $_POST['solucao']);

        if(empty($solution)){
          $solution = "Chamado concluído!";
        }

        $callInfo = "SELECT * FROM chamados WHERE id = '$callid'";

        $queryCallInfo = mysqli_query($connect, $callInfo);
        $resultCallInfo = mysqli_fetch_array($queryCallInfo);

        $emailBody = "<body style='background-color:#FFFF; width:100%; margin: 0; font-family:Arial'>

        <div style='background-color:#03216F;padding:20px 0; margin: 0;'>
          <h3 style='color:#FFF;text-align:center;'>SEU CHAMADO #$callid FOI CONCLUÍDO!</h3>
        </div>
      
        <div style='background-color:#fff; margin: 0; padding: 10px; text-align: center;'>
          <p style='font-weight:bold; text-transform:uppercase;'>Confira os dados do seu chamado</p>
        </div>
      
          <table width='100%' style='margin:0; padding:0;' border='0'>
            <tbody>
              <tr>
                <td width='200px' style='background-color: #03216F; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;border-top-left-radius:8px'>Assunto</td>
                <td style='background-color: #CFD5E3; padding: 0 8px; border-top-right-radius:8px'>".$resultCallInfo['assunto']."</td>
              </tr>
              <tr>
                <td width='200px' style='background-color: #03216F; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;'>Descrição:</td>
                <td style='background-color: #CFD5E3; padding: 0 8px'>".$resultCallInfo['descricao']."</td>
              </tr>
              <tr>
                <td width='200px' style='background-color: #03216F; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;'>Status atual:</td>
                <td style='background-color: #CFD5E3; padding: 0 8px'>$status</td>
              </tr>
              <tr>
                <td width='200px' style='background-color: #03216F; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;'>Detalhamento da Solução:</td>
                <td style='background-color: #CFD5E3; padding: 0 8px'>$solution</td>
              </tr>
              <tr>
                <td width='200px' style='background-color: #03216F; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;'>Data de Fechamento:</td>
                <td style='background-color: #CFD5E3; padding: 0 8px'>$date</td>
              </tr>
            </tbody>
          </table>
      </body>";

        $mail = new PHPMailer();
        $mail-> IsSMTP();
        $mail-> Host = 'smtps.uhserver.com';
        $mail-> SMTPAuth = true;
        $mail-> SMTPSecure = 'ssl';
        $mail-> Username = 'contato@vipextransportes.com.br';
        $mail-> Password = '2445cont1180';
        $mail-> Port = 465;
        $mail->setFrom('contato@vipextransportes.com.br', 'Helpdesk VIPEX | Central de Suporte');
        $mail->addReplyTo('no-reply@vipextransportes.com.br');
        $mail->addAddress($resultCallInfo['email']);
        $mail->isHTML(true);
        $mail->Subject = "Seu chamado foi concluído | Central de Suporte";
        $mail->Body = nl2br($emailBody);
        $mail->AltBody = nl2br(strip_tags($emailBody));
        $mail->CharSet = 'UTF-8';
        $mail->send();

        $finishCall = "UPDATE chamados SET status = '$status', solucao = '$solution', fechado = '$date' WHERE id = '$callid'";
        if(mysqli_query($connect, $finishCall)){
            $_SESSION['mensagem'] = "<div class='toast show top-0 end-0 text-bg-success border-0 ' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='150' data-bs-autohide='true'>
            <div class='d-flex'>
              <div class='toast-body'>
                Chamado finalizado com sucesso!
              </div>
              <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
            </div>
          </div>";
            header('Location: ../pages/meus-chamados.php');
        } else {
            $_SESSION['mensagem'] = "<div class='toast show top-0 end-0 text-bg-success border-0 ' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='150' data-bs-autohide='true'>
            <div class='d-flex'>
              <div class='toast-body'>
                Não foi possível finalizar o chamado. Tente novamente mais tarde!
              </div>
              <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
            </div>
          </div>";
            header('Location: ../pages/meus-chamados.php');
        }

    }