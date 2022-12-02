<?php

    date_default_timezone_set('America/Sao_Paulo');

    session_start();

    require_once 'db_connect.php';

    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\Exception;

    // require '../../PHPMailer/src/Exception.php';
    // require '../../PHPMailer/src/PHPMailer.php';
    // require '../../PHPMailer/src/SMTP.php';

    header('Content-Type: text/html; charset=utf-8');

    if(isset($_POST['hostid'], $_POST['title'], $_POST['host'], $_POST['email'], $_POST['start'], $_POST['end'])){
        $id = mysqli_escape_string($connect, $_POST['id']);
        $verified = mysqli_escape_string($connect, $_POST['verified']);
        $hostid = mysqli_escape_string($connect, $_POST['hostid']);
        $title = mysqli_escape_string($connect, $_POST['title']);
        $host = mysqli_escape_string($connect, $_POST['host']);
        $email = mysqli_escape_string($connect, $_POST['email']);
        $guests_conv = str_replace(',', ';', $guests);
            
        $data_start = str_replace('/', '-', $_POST['start']);
        $data_start_conv = date("Y-m-d H:i:s", strtotime($data_start));
        $data_start_datetime = new DateTime($data_start_conv);

        $data_end = str_replace('/', '-', $_POST['end']);
        $data_end_conv = date("Y-m-d H:i:s", strtotime($data_end));
        $data_end_datetime = new DateTime($data_end_conv);

        $sqlverifiedDate = "SELECT * FROM reservations WHERE room = '$room' AND '$data_start_conv' < end AND '$data_end_conv' > start AND id != '$id'";
        $verifyDate = mysqli_query($connect, $sqlverifiedDate);
        $resultDate = mysqli_fetch_array($verifyDate);

        if(!empty($resultDate)){
            $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">ERRO: RESERVA NÃO REALIZADA! DATA E HORA NÃO DISPONÍVEL</div>'];
            
            header('Content-Type: application/json');
            echo json_encode($retorna);

            exit;
        }

        if($verified == $hostid){
            $sql = "UPDATE reservations SET title = '$title', host = '$host', email = '$email', start = '$data_start_conv', end = '$data_end_conv' WHERE id = $id";
        
            if(mysqli_query($connect, $sql)){
                $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">SUCESSO: RESERVA ATUALIZADA COM SUCESSO!</div>'];
                $_SESSION['msg'] = '<div class="alert alert-success" role="alert">SUCESSO: RESERVA ATUALIZADA COM SUCESSO!</div>';
                

                // $emailBody = "
                //     <html>
                //         <h2>SUA REUNIÃO FOI AGENDADA!</h2>
                //         <p>Seguem os dados referente a reunião</p>
                //         <ul>
                //             <li style='list-style: none'><strong>Título:</strong> $title</li>
                //             <li style='list-style: none'><strong>Anfitrião:</strong> $host</li>
                //             <li style='list-style: none'><strong>E-mail:</strong> $email</li>
                //             <li style='list-style: none'><strong>Convidados:</strong> $guests</li>
                //             <li style='list-style: none'><strong>Sala escolhida:</strong> $room</li>
                //             <li style='list-style: none'><strong>Início:</strong> $data_start_conv</li>
                //             <li style='list-style: none'><strong>Término:</strong> $data_end_conv</li>
                //         </ul>
                //     </html>";

                // $mail =  new PHPMailer();
                // $mail-> IsSMTP();
                // $mail-> Host = 'smtps.uhserver.com';
                // $mail-> SMTPAuth = true;
                // $mail-> SMTPSecure = 'ssl';
                // $mail-> Username = 'comunica@vipextrans.com.br';
                // $mail-> Password = '';
                // $mail-> Port = 465;

                // $mail->setFrom('comunica@vipextrans.com.br');
                // $mail->addReplyTo('no-reply@vipextransportes.com.br');
                // $mail->addAddress("$email");
                // $mail->isHTML(true);
                // $mail->Subject = "VIPEX | Reunião Agendada";
                // $mail->Body = nl2br($emailBody);
                // $mail->AltBody = nl2br(strip_tags($emailBody));
                // $mail->CharSet = 'UTF-8';

                // if(!$mail->send()){
                //     echo "Não foi possível enviar a mensagem via e-mail. <br>";
                //     echo "Erro: ".$mail->ErrorInfo;
                // };

            }
        } else {
            $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">ERRO: VOCÊ TENTOU EDITAR UMA RESERVA QUE NÃO ERA SUA!</div>'];
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>ERRO: VOCÊ TENTOU EDITAR UMA RESERVA QUE NÃO ERA SUA!</div>";
        }

    };

    
    header('Content-Type: application/json');
    echo json_encode($retorna);