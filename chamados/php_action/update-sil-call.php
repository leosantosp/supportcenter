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

        $callInfo = "SELECT * FROM chamados_sil WHERE id = '$callid'";

        $queryCallInfo = mysqli_query($connect, $callInfo);
        $resultCallInfo = mysqli_fetch_array($queryCallInfo);
        $cardidSIL = $resultCallInfo['card_id'];
        $chamadoidSIL = $resultCallInfo['chamado_id'];
        $assuntoSIL = $resultCallInfo['assunto'];

        $numberSIL = "";

        if($chamadoidSIL !== 0){
            $numberSIL = "#SIL-".$cardidSIL;
        } else {
            $numberSIL = "#".$chamadoidSIL;
        }


        if($status == "Aguardando Orçamento" OR $status == "Orçamento em Aprovação" OR $status == "Gerando versão" OR $status == "Fase de Testes" OR $status == "Reunião agendada"){
            $emailBody = "<body style='background-color:#FFFF; width:100%; margin: 0; font-family:Arial'>

            <div style='background-color:#03216F;padding:20px 0; margin: 0;'>
            <h3 style='color:#FFF;text-align:center;text-transform:uppercase;'>SEU CHAMADO $numberSIL FOI PARA '$status'!</h3>
            </div>
        
            <div style='background-color:#fff; margin: 0; padding: 10px; text-align: center;'>
                <p style='font-weight:bold; text-transform:uppercase;'>Confira os dados do chamado</p>
            </div>
        
            <table width='100%' style='margin:0; padding:0; font-family:Arial' border='0'>
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
                    <td width='200px' style='background-color: #03216F; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;'>Observações:</td>
                    <td style='background-color: #CFD5E3; padding: 0 8px'>".$resultCallInfo['observacoes']."</td>
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
            $mail->setFrom('contato@vipextransportes.com.br' , 'CHAMADOS SIL | Central de Suporte');
            $mail->addReplyTo('no-reply@vipextransportes.com.br');
            $mail->addAddress('sidnei.oliveira@vipextransportes.com.br');
            $mail->addCC('leonardo.santos@vipextransportes.com.br');
            $mail->isHTML(true);
            $mail->Subject = "Seu chamado SIL foi atualizado | Central de Suporte";
            // $mail->addEmbeddedImage('/images/_Layer_.png', 'layer_cid', '_Layer_.png');
            // $mail->addEmbeddedImage('/images/bee.png', 'bee_cid', 'bee.png');
            // $mail->addEmbeddedImage('/images/Group_5_2.png', 'group_5_2_cid', 'Group_5_2.png');
            // $mail->addEmbeddedImage('/images/Group_6_2.png', 'group_6_2_cid', 'Group_6_2.png');
            // $mail->addEmbeddedImage('/images/Group_7_2.png', 'group_7_2_cid', 'Group_7_2.png');
            // $mail->addEmbeddedImage('/images/Group_8_2.png', 'group_8_2_cid', 'Group_8_2.png');
            // $mail->addEmbeddedImage('/images/hero-memorial-day.png', 'hero-memorial-day_cid', 'hero-memorial-day.png');
            // $mail->addEmbeddedImage('/images/logo.svg', 'logo_cid', 'logo.svg');
            $mail->Body = nl2br($emailBody);
            $mail->AltBody = nl2br(strip_tags($emailBody));
            $mail->CharSet = 'UTF-8';
            $mail->send();
        }


        $getCall = "UPDATE chamados_sil SET status = '$status' WHERE id = '$callid'";
        
        if(mysqli_query($connect, $getCall)){
            $_SESSION['mensagem'] = "<div class='alert alert-success'>Ação executada com sucesso</div>";
            header('Location: ../pages/sil-chamados.php');
        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger'>Ação não executada</div>";
            header('Location: ../pages/sil-chamados.php');
        }
                
        
    }