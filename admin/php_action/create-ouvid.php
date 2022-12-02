<?php

    session_start();

    require_once 'db_connect.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';

    header('Content-Type: text/html; charset=UTF-8');

    if(isset($_POST['company'], $_POST['department'], $_POST['name'], $_POST['phone'], $_POST['email'], $_POST['sector'], $_POST['notification'], $_POST['report'])){
        $company = mysqli_escape_string($connect, $_POST['company']);
        $department = mysqli_escape_string($connect, $_POST['department']);
        $name = mysqli_escape_string($connect, $_POST['name']);
        $phone = mysqli_escape_string($connect, $_POST['phone']);
        $email = mysqli_escape_string($connect, $_POST['email']);
        $sector = mysqli_escape_string($connect, $_POST['sector']);
        $notification = mysqli_escape_string($connect, $_POST['notification']);
        $report = mysqli_escape_string($connect, $_POST['report']);

        if($name == "" && $phone == "" && $email == "" && $sector == ""){
            $name = "Anônimo";
            $phone = "Anônimo";
            $email = "Anônimo";
            $sector = "Anônimo";
        }

        $emailBody = "
        <body style='background-color:#FFFF; width:100%; margin: 0; font-family:Arial'>

        <div style='background-color:blue;padding:20px 0; margin: 0;'>
          <h3 style='color:#FFF;text-align:center;'>NOVA NOTIFICAÇÃO RECEBIDA</h3>
        </div>
      
        <div style='background-color:#fff; margin: 0; padding: 10px; text-align: center;'>
          <p style='font-weight:bold; text-transform:uppercase;'>Confira os dados da notificação</p>
        </div>
      
          <table width='100%' style='margin:0; padding:0;' border='0'>
            <tbody>
              <tr>
                <td width='200px' style='background-color: blue; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;border-top-left-radius:8px'>Filial</td>
                <td style='background-color: #CFD5E3; padding: 0 8px; border-top-right-radius:8px'>$company</td>
              </tr>
              <tr>
                <td width='200px' style='background-color: blue; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;'>Departamento:</td>
                <td style='background-color: #CFD5E3; padding: 0 8px'>$department</td>
              </tr>
              <tr>
                <td width='200px' style='background-color: blue; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;'>Nome:</td>
                <td style='background-color: #CFD5E3; padding: 0 8px'>$name</td>
              </tr>
              <tr>
                <td width='200px' style='background-color: blue; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;'>Ramal: </td>
                <td style='background-color: #CFD5E3; padding: 0 8px'>$phone</td>
              </tr>
              <tr>
                <td width='200px' style='background-color: blue; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;'>E-mail: </td>
                <td style='background-color: #CFD5E3; padding: 0 8px'>$email</td>
              </tr>
              <tr>
                <td width='200px' style='background-color: blue; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;'>Setor:</td>
                <td style='background-color: #CFD5E3; padding: 0 8px'>$sector</td>
              </tr>
              <tr>
                <td width='200px' style='background-color: blue; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;'>notificação:</td>
                <td style='background-color: #CFD5E3; padding: 0 8px'>$notification</td>
              </tr>
              <tr>
                <td width='200px' style='background-color: blue; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;border-bottom-left-radius:8px'>Tipo</td>
                <td style='background-color: #CFD5E3; padding: 0 8px;border-bottom-right-radius:8px'>$report</td>
              </tr>
            </tbody>
          </table>
      </body>
        ";

        $mail = new PHPMailer();
        $mail -> IsSMTP();
        $mail -> Host = 'smtps.uhserver.com';
        $mail -> SMTPAuth = true;
        $mail -> SMTPSecure = 'ssl';
        $mail -> Username = 'ouvidoria@vipextransportes.com.br';
        $mail -> Password = 'O262V157D56';
        $mail -> Port = 465;
        $mail -> setFrom('ouvidoria@vipextransportes.com.br');
        $mail -> addReplyTo('no-reply@vipextransportes.com.br');
        $mail -> addAddress('leonardo.santos@vipextransportes.com.br');
        $mail -> isHTML(true);
        $mail -> Subject = "CANAL OUVIDORIA | Nova notificação";
        $mail -> Body = nl2br($emailBody);
        $mail -> AltBody = nl2br(strip_tags($emailBody));
        $mail ->CharSet = 'UTF-8';
        $mail ->send();

        $sql = "INSERT INTO ombudsman (company, department, name, phone, email, sector, notification, report) VALUES ('$company', '$department', '$name', '$phone', '$email', '$sector', '$notification', '$report')";

        if(mysqli_query($connect, $sql)){
            $_SESSION['mensagem'] = "<div class='alert alert-success'>Ação executada com sucesso!</div>";
            header('Location: ../../ouvidoria.php');
        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger'>Ação não executada</div>";
            header('Location: ../../ouvidoria.php');
        }
    }