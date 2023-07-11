<?php 
    /*Conexão */
    require_once 'php_action/db_connect.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';

    // Sessão -> Trabalhou com sessões, precisa usar o session-start
    session_start();

    /* Botão enviar */
    if(isset($_POST['btn-forgot'])):
        $erros = array();
        /** Necessário filtrar os dados por conta da busca que precisará ser feita no banco de dados 
         * 
         * mysqli_escape_string(conexao, parametroPOST);
        */
        $email = mysqli_escape_string($connect, $_POST['email']);
        
        /**
         * se(vazio$login ou vazio$password)
         */
        if(empty($email)):
            $erros[] = "<li> O e-mail precisa ser preenchido!</li>";
        else:
            $searchSQL = "SELECT * FROM usuarios WHERE email = '$email'";
            $querySQL = mysqli_query($connect, $searchSQL);
            $resultSQL = mysqli_fetch_array($querySQL);
            $newPassword = substr(md5(time()), 0, 6);
            $npcripto = md5($newPassword);
            

            
            /**
             * Armazenar o resultado da busca no banco de dados
             * primeiro parâmetro -> conexão
             * segundo parâmetro -> query 
             */

            $emailBody = "<body style='background-color:#FFFF; width:100%; margin: 0; font-family:Arial'>

            <div style='background-color:blue;padding:20px 0; margin: 0;'>
              <h3 style='color:#FFF;text-align:center;'>SUA SENHA FOI REDEFINIDA!</h3>
            </div>
          
            <div style='background-color:#fff; margin: 0; padding: 10px; text-align: center;'>
              <p style='font-weight:bold; text-transform:uppercase;'>Confira sua nova senha</p><br>
              <p style='font-weight:bold; text-transform:uppercase;'>Esta é uma senha provisória, acesse o painel com ela e altere sua senha em Editar perfil</p>
            </div>
          
              <table width='100%' style='margin:0; padding:0;' border='0'>
                <tbody>
                  <tr>
                    <td width='200px' style='background-color: blue; color: #FFF; font-weight:bold;text-transform: uppercase; padding: 16px 4px; text-align: center;border-top-left-radius:8px'>Sua nova senha é: </td>
                    <td style='background-color: #CFD5E3; padding: 0 8px; border-top-right-radius:8px'>".$newPassword."</td>
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
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = "Você redefiniu sua senha de acesso | Central de Suporte";
            $mail->Body = nl2br($emailBody);
            $mail->AltBody = nl2br(strip_tags($emailBody));
            $mail->CharSet = 'UTF-8';
            $mail->send();

            $sql = "UPDATE usuarios SET password = '$npcripto' WHERE email = '$email'";

            if(mysqli_query($connect, $sql)){
                $erros[] = '<li class="alert-warning-login alert alert-success" role="alert">
                    Foi encaminhado para seu e-mail uma nova senha
                </li>';
                header('Location: index.php');
            } else {
                $erros[] = '<div class="alert-warning-login alert alert-warning" role="alert">
                            Não conseguimos alterar a senha, tente novamente mais tarde!
                            </div>';
            }
        endif;

    endif;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci a Senha | Helpdesk VIPEX</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" type="image/x-icon" href="../assets/images/favicon.ico">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body id="login-page">
    <main class="row no-gutters">
        <section class="login-image col-md-7">
            <img class="img-fluid" src="assets/images/undraw_team_up_re_84ok.svg" alt="">
        </section>

        <section id="login" class="login-form col-12 col-md-5">
            
            <div class="login-card">
                <h2 class="login-card-title">ESQUECEU A SENHA</h2>
                            
                <!-- -->
                <form class="login-form-group" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <?php 
                                /**
                                 * Se o campo erro não estiver vazio
                                 * enquanto tiver erros, atribua a variável erro
                                 * e exiba o erro
                                 */
                                if(!empty($erros)):
                                    foreach($erros as $erro):
                                        echo $erro;
                                    endforeach;
                                endif;
                            ?>

                    <div class="form-group">
                        <label class="label-login" for="email">E-mail (E-mail corporativo para receber notificações)</label>
                        <input id="email" name="email" type="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-login" type="submit" name="btn-forgot">GERAR NOVA SENHA</button>
                    </div>
                </form>

                            
            </div>
        </section>
    </main>
    
    <script src="assets/js/main.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>