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

    if(isset($_POST['send-comment'])){
        $callid = mysqli_escape_string($connect, $_POST['callid']);
        $respid = mysqli_escape_string($connect, $_POST['respid']);
        $userid = mysqli_escape_string($connect, $_POST['userid']);
        $comment = mysqli_escape_string($connect, $_POST['comment']);

        $sql = "SELECT * FROM usuarios WHERE id = '$userid'";
        $userquery = mysqli_query($connect, $sql);
        $userreturn = mysqli_fetch_array($userquery);

        $callsql = "SELECT * FROM chamados WHERE id = '$callid'";
        $callquery = mysqli_query($connect, $callsql);
        $callreturn = mysqli_fetch_array($callquery);
        $assunto = $callreturn['assunto'];
        $descricao = $callreturn['descricao'];
        $solicitante = $callreturn['email'];
        $iddoresponsavel = $callreturn['responsavel'];
        
        $buscarEmailResp = "SELECT * FROM usuarios WHERE id = '$iddoresponsavel'";
        $executarEmailResp = mysqli_query($connect, $buscarEmailResp);
        $resultadoEmailResp = mysqli_fetch_array($executarEmailResp);
        if($resultadoEmailResp == NULL){
          $emailResponsavel = "dvr@vipextransportes.com.br";
        } else {
         $emailResponsavel = $resultadoEmailResp['email'];
        }

        

        $statusResponsavel = "Aguardando usuario";
        $statusAgente = "Aguardando responsavel";

        $emailHeader = "";

        if($userid == ''){
          $emailHeader = "VOCÊ RECEBEU UMA MENSAGEM";
        } else if($respid == ''){
          $emailHeader = "VOCÊ ENVIOU UMA MENSAGEM";
        }

        $emailBody = "<body style='background-color:#FFFF; width:100%; margin: 0; font-family:Arial'>

        <div style='background-color:#03216F;padding:20px 0; margin: 0;'>
          <h3 style='color:#FFF;text-align:center;'>$emailHeader NO SEU CHAMADO #$callid!</h3>
          <p style='color:#FFF;text-align:center;'>Acesse a aba de comentários do seu chamado e verifique a sua nova mensagem</p>
        </div>
      
        <div style='background-color:#fff; margin: 0; padding: 10px; text-align: center;'>
          <p style='font-weight:bold; text-transform:uppercase;'>Confira os dados do seu chamado</p>
        </div>
      
          <table width='100%' style='margin:0; padding:0;' border='0'>
            <tbody>
              <tr>
                <td width='200px' style='background-color: #03216F; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;border-top-left-radius:8px'>Assunto</td>
                <td style='background-color: #CFD5E3; padding: 0 8px; border-top-right-radius:8px'>$assunto</td>
              </tr>
              <tr>
                <td width='200px' style='background-color: #03216F; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;'>Descrição:</td>
                <td style='background-color: #CFD5E3; padding: 0 8px'>$descricao</td>
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
        $mail->addAddress($solicitante);
        $mail->isHTML(true);
        $mail->Subject = "Você tem uma nova mensagem | Central de Suporte";
        $mail->Body = nl2br($emailBody);
        $mail->AltBody = nl2br(strip_tags($emailBody));
        $mail->CharSet = 'UTF-8';
        $mail->send();

        if($userid == ''){
            $sqlInsert = "INSERT INTO chamados_comentarios (chamado_id, responsavel_id, comentario, envio) VALUES ('$callid', '$respid', '$comment', '$date')";
            $sqlStatus = "UPDATE chamados SET status = '$statusResponsavel' WHERE id = '$callid'";
        } else if($respid == ''){
            $sqlInsert = "INSERT INTO chamados_comentarios (chamado_id, agente_id, comentario, envio) VALUES ('$callid', '$userid', '$comment', '$date')";
            $sqlStatus = "UPDATE chamados SET status = '$statusAgente' WHERE id = '$callid'";
        }

        

        if(mysqli_query($connect, $sqlInsert) && mysqli_query($connect, $sqlStatus)){
            $_SESSION['mensagem'] = "<div class='toast show top-0 end-0 text-bg-success border-0 ' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='150' data-bs-autohide='true'>
            <div class='d-flex'>
              <div class='toast-body'>
                Comentário enviado com sucesso
              </div>
              <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
            </div>
          </div>";
            header('Location: ../pages/comments.php?id='.$callid.'');
        } else {
            $_SESSION['mensagem'] = "<div class='toast show top-0 end-0 text-bg-danger border-0 ' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='150' data-bs-autohide='true'>
            <div class='d-flex'>
              <div class='toast-body'>
                Não foi possível enviar o comentário. Tente novamente mais tarde
              </div>
              <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
            </div>
          </div>";
            header('Location: ../pages/list-chamados.php');
        }
    }