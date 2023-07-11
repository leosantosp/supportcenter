<?php 

    session_start();

    require_once 'db_connect.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';

    header('Content-Type: text/html; charset=utf-8');

    if(isset($_POST['updateStatus'])){
        $callid = mysqli_escape_string($connect, $_POST['callid']);
        $status = mysqli_escape_string($connect, $_POST['status']);

        $callInfo = "SELECT * FROM chamados WHERE id = '$callid'";

        $queryCallInfo = mysqli_query($connect, $callInfo);
        $resultCallInfo = mysqli_fetch_array($queryCallInfo);

        $emailBody = "<body style='background-color:#FFFF; width:100%; margin: 0; font-family:Arial'>

        <div style='background-color:#03216F;padding:20px 0; margin: 0;'>
          <h3 style='color:#FFF;text-align:center;text-transform:uppercase;'>SEU CHAMADO #$callid FOI PARA '$status'!</h3>
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
        $mail->setFrom('contato@vipextransportes.com.br' , 'Helpdesk VIPEX | Central de Suporte');
        $mail->addReplyTo('no-reply@vipextransportes.com.br');
        $mail->addAddress($resultCallInfo['email']);
        $mail->isHTML(true);
        $mail->Subject = "Seu chamado alterou o status | Central de Suporte";
        $mail->Body = nl2br($emailBody);
        $mail->AltBody = nl2br(strip_tags($emailBody));
        $mail->CharSet = 'UTF-8';
        $mail->send();

        $getCall = "UPDATE chamados SET status = '$status' WHERE id = '$callid'";
        
        if(mysqli_query($connect, $getCall)){
            $_SESSION['mensagem'] = "<div class='toast show top-0 end-0 text-bg-success border-0 ' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='150' data-bs-autohide='true'>
            <div class='d-flex'>
              <div class='toast-body'>
                Chamado atualizado com sucesso!
              </div>
              <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
            </div>
          </div>";
            header('Location: ../pages/meus-chamados.php');
        } else {
            $_SESSION['mensagem'] = "<div class='toast show top-0 end-0 text-bg-danger border-0 ' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='150' data-bs-autohide='true'>
            <div class='d-flex'>
              <div class='toast-body'>
                Ocorreu um problema ao atualizar o chamado. Tente novamente mais tarde
              </div>
              <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
            </div>
          </div>";
            header('Location: ../pages/meus-chamados.php');
        }
                
        
    }