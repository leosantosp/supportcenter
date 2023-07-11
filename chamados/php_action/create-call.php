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

    if(isset($_POST['assunto'], $_POST['description'], $_POST['userid'])){
        $assunto = mysqli_escape_string($connect, $_POST['assunto']);
        $descricao = mysqli_escape_string($connect, $_POST['description']);
        $userid = mysqli_escape_string($connect, $_POST['userid']);

        $sql = "SELECT * FROM usuarios WHERE id = '$userid'";
        $userquery = mysqli_query($connect, $sql);
        $userreturn = mysqli_fetch_array($userquery);

        $username = $userreturn['username'];
        $userestab = $userreturn['estabelecimento'];
        $userpc = $userreturn['pc'];
        $userphone = $userreturn['ramal'];
        $useremail = $userreturn['email'];

        $formatosPermitidos = array("pdf", "docx", "xlsx", "csv", "xlsb", "xls", "txt", "rtf", "doc", "docm", "png", "jpg", "jpeg", "gif");
        $quantidadeArquivos = count($_FILES['files']['name']);
        $contador = 0;
        $fileNames = "";

        $status = "Em triagem";

        mkdir("../assets/files/$assunto"."$userid".time()."/", 0777, true);
        $pasta = "../assets/files/$assunto"."$userid".time()."/";
        chmod($pasta, 0777);

        while($contador < $quantidadeArquivos){
            $extensao = pathinfo($_FILES['files']['name'][$contador], PATHINFO_EXTENSION);

            if(in_array($extensao, $formatosPermitidos)){
                
                $temporario = $_FILES['files']['tmp_name'][$contador];
                $novoNome = $_FILES['files']['name'][$contador];

                $novoNomeUnderscore = str_replace(" ", "_", $novoNome);

                $files = [];
                array_push($files, $novoNomeUnderscore);

                if(move_uploaded_file($temporario, $pasta.$novoNomeUnderscore)){
                    echo "Upload feito com sucesso! <br>";
                } else {
                    echo "Não foi possível fazer o upload! <br>";
                }

                $fileNames = $fileNames.$novoNomeUnderscore.";";
            } else {
                $mensagem = "$extensao não é um formato válido!";
            }

            $contador++;
        }

        

        $emailBody = "<body style='background-color:#FFFF; width:100%; margin: 0; font-family:Arial'>

        <div style='background-color:#03216F;padding:20px 0; margin: 0;'>
          <h3 style='color:#FFF;text-align:center;'>RECEBEMOS O SEU CHAMADO!</h3>
          <p style='color:#FFF;text-align:center;'>Em breve, nossa equipe de T.I irá atendê-lo</p>
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
              <tr>
                <td width='200px' style='background-color: #03216F; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;'>Status atual:</td>
                <td style='background-color: #CFD5E3; padding: 0 8px'>$status</td>
              </tr>
              
              <tr>
                <td width='200px' style='background-color: #03216F; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;'>Data de Abertura:</td>
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
        $mail->addAddress($useremail);
        $mail->isHTML(true);
        $mail->Subject = "Recebemos seu chamado | Central de Suporte";
        $mail->Body = nl2br($emailBody);
        $mail->AltBody = nl2br(strip_tags($emailBody));
        $mail->CharSet = 'UTF-8';
        $mail->send();

        $sqlInsert = "INSERT INTO chamados (username, estabelecimento, pc, ramal, email, assunto, descricao, filename, status, username_id, abertura, diretorio) VALUES ('$username', '$userestab', '$userpc', '$userphone', '$useremail', '$assunto', '$descricao', '$fileNames', '$status', '$userid', '$date', '$pasta')";

        if(mysqli_query($connect, $sqlInsert)){
            $_SESSION['mensagem'] = "<div class='toast show top-0 end-0 text-bg-success border-0 ' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='150' data-bs-autohide='true'>
            <div class='d-flex'>
              <div class='toast-body'>
                Chamado aberto com sucesso!
              </div>
              <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
            </div>
          </div>";
            header('Location: ../pages/list-chamados.php');
        } else {
            $_SESSION['mensagem'] = "<div class='toast show top-0 end-0 text-bg-danger border-0 ' role='alert' aria-live='assertive' aria-atomic='true' data-bs-delay='150' data-bs-autohide='true'>
            <div class='d-flex'>
              <div class='toast-body'>
                Não foi possível abrir o chamado! Entre em contato com a equipe de T.I
              </div>
              <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
            </div>
          </div>";
            header('Location: ../pages/list-chamados.php');
        }
    }