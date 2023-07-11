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
        $username = mysqli_escape_string($connect, $_POST['username']);
        $pc = mysqli_escape_string($connect, $_POST['pc']);
        $ramal = mysqli_escape_string($connect, $_POST['ramal']);
        $estabelecimento = mysqli_escape_string($connect, $_POST['estabelecimento']);
        $department = mysqli_escape_string($connect, $_POST['department']);
        $profile = "user";
        $permission = 0;
        $emailtext = mysqli_escape_string($connect, $_POST['emailtext']);
        $dominio = mysqli_escape_string($connect, $_POST['dominio']);
        $email = $emailtext.$dominio;
        $login = mysqli_escape_string($connect, $_POST['login']);
        $password = mysqli_escape_string($connect, $_POST['password']);
        $password = md5($password);

        $email = strtolower($email);
        $pc = strtoupper($pc);

        function capitalizeWords($username){

            //Converte a string para minúsculas
            $username = strtolower($username);

            //Divide a string em palavras
            $words = explode(' ', $username);

            // Itera pelas palavras e capitaliza a primeira letra
            foreach($words as $word){
                $word = ucfirst($word);
            }

            //Junta as palavras novamente em uma string
            $capitalizedString = implode(' ', $words);

            //Retorna a string com a formatação desejada
            return $capitalizedString;
        }

        $usernameTratado = capitalizeWords($username);

        /**
         * se(vazio$login ou vazio$password)
         */
        if(empty($login) || empty($password) || empty($username) || empty($pc) || empty($ramal) || empty($estabelecimento)):
            $erros[] = "<li> Todos os campos precisam serem preenchidos</li>";
        else:
            $analise = "SELECT * FROM usuarios WHERE login = '$login' OR email = '$email'";
            $executeAnalise = mysqli_query($connect, $analise);

            if(mysqli_num_rows($executeAnalise) !== 0){
                $erros[] = "<li class='alert alert-warning' style='text-align:center'>O e-mail/login informado já está cadastrado no sistema</li>";
            } else {
                $sql = "INSERT INTO usuarios (username, pc, ramal, estabelecimento, profile, permission, email, login, password, department) VALUES ('$username', '$pc', '$ramal', '$estabelecimento', '$profile', '$permission', '$email', '$login', '$password', '$department')";
                /**
                 * Armazenar o resultado da busca no banco de dados
                 * primeiro parâmetro -> conexão
                 * segundo parâmetro -> query 
                 */

                if(mysqli_query($connect, $sql)){
                    $_SESSION['mensagem'] = "<li class='alert alert-success' style='text-align:center'>Conta criada com sucesso!</li>";
                    header('Location: index.php');
                } else {
                    $_SESSION['mensagem'] = "<div class='alert alert-danger'>Ação não executada</div>";
                    header('Location: index.php');
                }
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
    <title>Iniciar Sessão | Chamados</title>
    <link rel="stylesheet" href="assets/css/style.css">
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
                <h2 class="login-card-title">CRIAR CONTA</h2>

                
                            
                <!-- -->
                <form class="login-form-group" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                      <?php 
                
                        if(!empty($erros)):
                            foreach($erros as $erro):
                                echo $erro;
                            endforeach;
                        endif;

                       
                        if(isset($_SESSION['mensagem'])){
                            echo $_SESSION['mensagem'];
                            unset($_SESSION['mensagem']);
                        }

                    ?>
                    <p style="color: #FFF; text-align: center;">Esta conta também pode ser utilizada para agendamento de reuniões na funcionalidade de Reserva de Salas</p>

                    <div class="form-group">
                        <label class="label-login" for="username">Nome de Exibição (Insira nome e sobrenome)</label>
                        <input id="username" name="username" type="text" class="form-control" required placeholder="Ex: Leonardo Santos (primeiras letras maiúsculas)">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label class="label-login" for="pc">Máquina (Ex: VIPEXGRU000)</label>
                                <input id="pc" name="pc" type="text" class="form-control" required placeholder="Ex: VIPEXGRU000">
                            </div>
                            <div class="col">
                                <label class="label-login" for="ramal">Ramal ou Fila</label>
                                <input id="ramal" name="ramal" type="phone" class="form-control" required placeholder="Ex: 1209">
                            </div>
                        </div>
                        
                    </div>

                    

                    <div class="form-group">
                        <label class="label-login" for="email">E-mail (E-mail corporativo para receber notificações)</label>
                        <div class="row">
                            <div class="col">
                            <input id="emailtext" name="emailtext" type="text" class="form-control" required placeholder="Ex: leonardo.santos"></div>
                            <div class="col"><select class="form-control" name="dominio" id="dominio">
                                <option disabled selected>@dominio.com.br</option>
                                <option value="@vipextransportes.com.br">@vipextransportes.com.br</option>
                                <option value="@viptransportes.com.br">@viptransportes.com.br</option>
                                <option value="@vpxlogistica.com.br">@vpxlogistica.com.br</option>
                            </select></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label class="label-login" for="estabelecimento">Estabelecimento</label>
                                <select id="estabelecimento" name="estabelecimento" class="form-control" required>
                                    <option selected disabled>Escolha uma unidade</option>
                                    <option value="02 - RIO">02 - RIO</option>
                                    <option value="04 - CTB">04 - CTB</option>
                                    <option value="05 - BGV">05 - BGV</option>
                                    <option value="06 - LDA">06 - LDA</option>
                                    <option value="08 - MRG">08 - MRG</option>
                                    <option value="09 - FLN">09 - FLN</option>
                                    <option value="11 - GRU">11 - GRU</option>
                                    <option value="17 - BHZ">17 - BHZ</option>
                                    <option value="19 - SUM">19 - SUM</option>
                                    <option value="20 - SSA">20 - SSA</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="department">Departamento</label>
                                <select class="form-control" name="department" id="department" required>
                                    <option selected disabled>Escolha o departamento</option>
                                    <option value="Arquivo">Arquivo</option>
                                    <option value="Operacional">Operacional</option>
                                    <option value="Recebimento">Recebimento</option>
                                    <option value="Assistência">Assistência</option>
                                    <option value="Comercial ADM">Comercial ADM</option>
                                    <option value="Comercial Vendas">Comercial Vendas</option>
                                    <option value="Comercial Cotação">Comercial Cotação</option>
                                    <option value="Comercial Monitoria">Comercial Monitoria</option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="SAC Rastreio">SAC Rastreio</option>
                                    <option value="SAC Coletas">SAC Coletas</option>
                                    <option value="Financeiro">Financeiro</option>
                                    <option value="Controladoria">Controladoria</option>
                                    <option value="RH">RH</option>
                                    <option value="DP">DP</option>
                                    <option value="TI">TI</option>
                                    <option value="Gerencia">Gerencia</option>
                                    <option value="Administrativo">Administrativo</option>
                                    <option value="Frota">Frota</option>
                                    <option value="Compras">Compras</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>

                    <div class="form-group">
                        <label class="label-login" for="login">Login (Você utilizará este para acessar a plataforma)</label>
                        <input id="login" name="login" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input id="password" name="password" type="password" class="form-control" required>
                        <input type="checkbox" onclick="revealPassword()" id="showPass"> <label for="showPass" style="color: #FFF"> Mostrar senha</label>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-login" type="submit" name="btn-create">CRIAR CONTA</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <script>
        function revealPassword(){
            var x = document.getElementById("password");
            if (x.type === "password"){
                x.type = "text"
            } else {
                x.type = "password";
            }
        }
    </script>
    
    <script src="assets/js/main.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>