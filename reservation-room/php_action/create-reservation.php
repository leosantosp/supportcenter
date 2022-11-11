<?php

    session_start();

    require_once 'db_connect.php';

    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\Exception;

    // require '../../PHPMailer/src/Exception.php';
    // require '../../PHPMailer/src/PHPMailer.php';
    // require '../../PHPMailer/src/SMTP.php';

    

    header('Content-Type: text/html; charset=utf-8');

    if(isset($_POST['hostid'], $_POST['title'], $_POST['host'], $_POST['email'], $_POST['guests'], $_POST['rooms'], $_POST['start'], $_POST['end'])){
        $hostid = mysqli_escape_string($connect, $_POST['hostid']);
        $title = mysqli_escape_string($connect, $_POST['title']);
        $host = mysqli_escape_string($connect, $_POST['host']);
        $email = mysqli_escape_string($connect, $_POST['email']);
        $guests = mysqli_escape_string($connect, $_POST['guests']);
        $room = mysqli_escape_string($connect, $_POST['rooms']);
            
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
            $_SESSION['mensagem'] = "<div class='alert alert-danger'>ERRO: Reserva não realizada! Data e Hora não disponíveis</div>" ;
            header("Location: ../home.php");

            exit;
        }

        $sql = "INSERT INTO reservations (title, host, hostid, email, guests, room, start, end) VALUES ('$title', '$host', '$hostid', '$email', '$guests', '$room', '$data_start_conv', '$data_end_conv')";
        
        if(mysqli_query($connect, $sql)){
            $_SESSION['mensagem'] = "<div class='alert alert-success'>Ação executada com sucesso!</div>" ;
            
            

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
            // }
            
            header("Location: ../home.php");
        } else{
            $_SESSION['mensagem'] = "<div class='alert alert-danger'>Ação não executada</div>";
            header("Location: ../home.php");
        }



    };

    
    header('Content-Type: application/json');
    echo json_encode($retorna);