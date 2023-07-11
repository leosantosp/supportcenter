<?php 

    include_once '../php_action/db_connect.php';

    session_start();

    if(!isset($_SESSION['logado'])):
        header('Location: index.php');
    endif;

    // Captura de dados
    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);

    if($dados['profile'] == "author"){
        header('Location: home.php');
    }

    include_once '../includes/header.php';
?>

<div class="row no-gutters">
        <div class="usersadd-section col-12 col-md-8 offset-md-2">
            <h3 class="page-title"><ion-icon name="person-add-outline"></ion-icon> Novo Usuário</h3>
            <form class="addform" action="../php_action/create-users.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" type="text" name="username" id="username">
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input class="form-control" type="email" name="email" id="email">
                </div>

                <div class="form-group">
                    <label for="login">Login</label>
                    <input class="form-control" type="text" name="login" id="login">
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input class="form-control" type="password" name="password" id="password">
                    <input hidden id="reveal" type="checkbox" class="form-control" onclick="revealPassword()"> <label for="reveal" class="btn-reveal btn-primary">Mostrar <ion-icon name="eye-outline"></ion-icon></label>
                </div>

                <div class="form-group">
                    <label for="profile">Profile</label>
                    <select class="form-control" name="profile" id="profile">
                        <option selected disabled hidden>Selecione uma unidade</option>
                        <option value="ti">Admin</option>
                        <option value="com">Comercial</option>
                        <option value="sac">SAC</option>
                        <option value="adm">Administrativo</option>
                        <option value="ctrl">Controladoria</option>
                        <option value="fin">Financeiro</option>
                        <option value="cob">Cobrança</option>
                        <option value="ope">Operacional</option>
                        <option value="ass">Assistência</option>
                        <option value="dp">DP</option>
                        <option value="rh">RH</option>
                        <option value="dir">Diretoria</option>
                        <option value="mnt">Monitoria</option>
                        <option value="fro">Frota</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="permission">Nível de Permissão: 0 -> Não permite alterar / 1 -> Permite alterar</label>
                    <select name="permission" id="permission" class="form-control">
                        <option value="0">0 -> Não permite fazer alterações no Aprenda</option>
                        <option value="1">1 -> Permite fazer alterações no Aprenda</option>
                    </select>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" name="btn-cadastrar" class="btn btn-success"><ion-icon name="add-outline"></ion-icon> Cadastrar</button>
                    <a href="users-list.php" class="btn btn-primary"><ion-icon name="arrow-back-outline"></ion-icon> Voltar</a>
                </div>
            </form>

            <br>
        </div>
    </div>

    <script>
        function revealPassword(){
            var x = document.getElementById("password");
            if(x.type === "password"){
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

<?php 
    include_once '../includes/footer.php';
?>