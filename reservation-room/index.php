<?php

// Realizando a conexão
require_once 'php_action/db_connect.php';

// Iniciando a sessão
session_start();

// Botão enviar
    if(isset($_POST['login'], $_POST['password'])):
        $erros = array(); // Os erros emitidos pelo sistema serão armazenados nessa array

        // Atribuindo as informações de login e senha para variáveis
        $login = mysqli_escape_string($connect, $_POST['login']);
        $password = mysqli_escape_string($connect, $_POST['password']);

        // Realizando verificação
        if(empty($login) || empty($password)):
            $erros[] = "<li>O campo login/senha precisa ser preenchido</li>";
        else:
            //Verificando se o login informado existe no banco de dados
            $sql = "SELECT login FROM usuarios WHERE login = '$login'";
            $resultado = mysqli_query($connect, $sql);

            if(mysqli_num_rows($resultado) > 0):
                $password = md5($password);
                $sql = "SELECT * FROM usuarios WHERE login = '$login' AND password = '$password'";
                $resultado = mysqli_query($connect, $sql);

                    if(mysqli_num_rows($resultado) == 1):
                        $dados = mysqli_fetch_array($resultado);
                        mysqli_close($connect);
                        $_SESSION['logado'] = true;
                        $_SESSION['id_usuario'] = $dados['id'];
                        header('Location: home.php');
                    else:
                        $erros[] = '<div class="alert-warning-login alert alert-warning" role="alert">
                                        Usuário/Senha não conferem!
                                    </div>';
                    endif;
            else:
                $erros[] = '<div class="alert-warning-login alert alert-danger" role="alert">
                                Usuário não encontrado!<br> Verifique os dados inseridos
                            </div>';
            endif;

        endif;
    endif;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body id="login-page">
    <main>
        <section id="login">
            <div class="container">
                <div class="row">
                    <article class="col-12 login-bg">
                        <div class="login-card">
                            <img class="profile-user img-fluid" src="assets/images/profile-user.png" alt="">    
                            
                            <!-- -->
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <div class="form-group">
                                    <label for="login">Login</label>
                                    <input id="login" name="login" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" name="password" type="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-login" type="submit" name="btn-entrar">ENTRAR</button>
                                </div>
                            </form>

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
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </main>
    
    <script src="assets/js/main.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>