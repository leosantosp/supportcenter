<?php 
    /*Conexão */
    require_once 'php_action/db_connect.php';

    // Sessão -> Trabalhou com sessões, precisa usar o session-start
    session_start();

    /* Botão enviar */
    if(isset($_POST['login'], $_POST['password'])):
        $erros = array();
        /** Necessário filtrar os dados por conta da busca que precisará ser feita no banco de dados 
         * 
         * mysqli_escape_string(conexao, parametroPOST);
        */
        $login = mysqli_escape_string($connect, $_POST['login']);
        $password = mysqli_escape_string($connect, $_POST['password']);
        /**
         * se(vazio$login ou vazio$password)
         */
        if(empty($login) || empty($password)):
            $erros[] = "<li> O campo login/senha precisa ser preenchido</li>";
        else:
            $sql = "SELECT login FROM usuarios WHERE login = '$login'";
            /**
             * Armazenar o resultado da busca no banco de dados
             * primeiro parâmetro -> conexão
             * segundo parâmetro -> query 
             */
            $resultado = mysqli_query($connect, $sql);

            /**
             * Se, as linhas retornadas na pesquisa for maior que 0, execute a função de comparação para verificar se a senha existe no banco
             * caso contrário, seja igual a 0. Emita um alerta dizendo que usuário não existe no banco de dados
             */
            if(mysqli_num_rows($resultado) > 0):
                /**
                 * Criptografamos a senha antes de jogá-la no SELECT para avaliar
                 */
                $password = md5($password);
                $sql = "SELECT * FROM usuarios WHERE login = '$login' AND password = '$password'";
                $resultado = mysqli_query($connect, $sql);
                $dados = mysqli_fetch_array($resultado);

                    /**
                     * Verificar se no banco de dados existe um login ou senha igual ao digitado
                     * Caso tenha, execute a função
                     */
                    if(mysqli_num_rows($resultado) == 1 AND $dados['profile'] == "ti" ):

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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sessão | Central de Suporte</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body id="login-page">
    <main class="row no-gutters">
        <section class="login-image col-md-7">
            <img class="img-fluid" src="assets/images/login-index-bg.svg" alt="">
        </section>

        <section id="login" class="login-form col-12 col-md-5">
            
            <div class="login-card">
                <h2 class="login-card-title">Iniciar Sessão</h2>

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
                            
                <!-- -->
                <form class="login-form-group" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-group">
                        <label class="label-login" for="login">Login</label>
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

                            
            </div>
        </section>
    </main>
    
    <script src="assets/js/main.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>