<?php

    date_default_timezone_set('America/Sao_Paulo');

    session_start();

    require_once 'db_connect.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';

    header('Content-Type: text/html; charset=utf-8');
            

    if(isset($_POST['hostid'], $_POST['title'], $_POST['host'], $_POST['email'], $_POST['guests'], $_POST['rooms'], $_POST['start'], $_POST['end'])){
        $hostid = mysqli_escape_string($connect, $_POST['hostid']);
        $title = mysqli_escape_string($connect, $_POST['title']);
        $host = mysqli_escape_string($connect, $_POST['host']);
        $email = mysqli_escape_string($connect, $_POST['email']);
        $guests = mysqli_escape_string($connect, $_POST['guests']);
        $room = mysqli_escape_string($connect, $_POST['rooms']);
        $guests_conv = str_replace(',', ';', $guests);
            
        $data_start = str_replace('/', '-', $_POST['start']);
        $data_start_conv = date("Y-m-d H:i:s", strtotime($data_start));
        $data_start_datetime = new DateTime($data_start_conv);

        $data_end = str_replace('/', '-', $_POST['end']);
        $data_end_conv = date("Y-m-d H:i:s", strtotime($data_end));
        $data_end_datetime = new DateTime($data_end_conv);

        $sqlverifiedDate = "SELECT * FROM reservations WHERE room = '$room' AND '$data_start_conv' < end AND '$data_end_conv' > start";
        $verifyDate = mysqli_query($connect, $sqlverifiedDate);
        $resultDate = mysqli_fetch_array($verifyDate);

        if(!empty($resultDate)){
            $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">ERRO: RESERVA NÃO REALIZADA! DATA E HORA NÃO DISPONÍVEL</div>'];
            
            header('Content-Type: application/json');
            echo json_encode($retorna);

            exit;
        }

            


        $guestlist = explode(',', $guests);

        $emailBody = "<body style='background-color:#FFFF; width:100%; margin: 0; font-family:Arial'>

        <div style='background-color:blue;padding:20px 0; margin: 0;'>
          <h3 style='color:#FFF;text-align:center;'>SUA REUNIÃO FOI AGENDADA COM SUCESSO!</h3>
        </div>
      
        <div style='background-color:#fff; margin: 0; padding: 10px; text-align: center;'>
          <p style='font-weight:bold; text-transform:uppercase;'>Confira os dados da sua reunião</p>
        </div>
      
          <table width='100%' style='margin:0; padding:0;' border='0'>
            <tbody>
              <tr>
                <td width='200px' style='background-color: blue; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;border-top-left-radius:8px'>Título</td>
                <td style='background-color: #CFD5E3; padding: 0 8px; border-top-right-radius:8px'>$title</td>
              </tr>
              <tr>
                <td width='200px' style='background-color: blue; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;'>Anfitrião:</td>
                <td style='background-color: #CFD5E3; padding: 0 8px'>$host</td>
              </tr>
              <tr>
                <td width='200px' style='background-color: blue; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;'>E-mail:</td>
                <td style='background-color: #CFD5E3; padding: 0 8px'>$email</td>
              </tr>
              <tr>
                <td width='200px' style='background-color: blue; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;'>Convidados: </td>
                <td style='background-color: #CFD5E3; padding: 0 8px'>$guests</td>
              </tr>
              <tr>
                <td width='200px' style='background-color: blue; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;'>Sala escolhida: </td>
                <td style='background-color: #CFD5E3; padding: 0 8px'>$room</td>
              </tr>
              <tr>
                <td width='200px' style='background-color: blue; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;'>Início:</td>
                <td style='background-color: #CFD5E3; padding: 0 8px'>$data_start</td>
              </tr>
              <tr>
                <td width='200px' style='background-color: blue; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;border-bottom-left-radius:8px'>Término</td>
                <td style='background-color: #CFD5E3; padding: 0 8px;border-bottom-right-radius:8px'>$data_end</td>
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
        $mail->setFrom('contato@vipextransportes.com.br');
        $mail->addReplyTo('no-reply@vipextransportes.com.br');            
        $mail->addAddress($email);
        


        foreach($guestlist as $guestmail){
            $mail->addAddress($guestmail);
        }

        $mail->isHTML(true);
        $mail->Subject = "Sua Reunião foi agendada | Central de Suporte";
        $mail->Body = nl2br($emailBody);
        $mail->AltBody = nl2br(strip_tags($emailBody));
        $mail->CharSet = 'UTF-8';
        $mail->send();

        $sql = "INSERT INTO reservations (title, host, hostid, email, guests, room, start, end) VALUES ('$title', '$host', '$hostid', '$email', '$guests_conv', '$room', '$data_start_conv', '$data_end_conv')";

        if(mysqli_query($connect, $sql)){


            

            $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">SUCESSO: RESERVA REALIZADA COM SUCESSO!</div>'];
            $_SESSION['msg'] = '<div class="alert alert-success" role="alert">SUCESSO: RESERVA REALIZADA COM SUCESSO!</div>';

        } else{
            $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">ERRO: RESERVA NÃO REALIZADA! VERIFIQUE OS CAMPOS E PREENCHA NOVAMENTE</div>'];
        }

    };

    
    header('Content-Type: application/json');
    echo json_encode($retorna);