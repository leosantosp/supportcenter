<?php
    // Iniciando conexão
    include_once '../php_action/db_connect.php';

    session_start(); // Iniciando a sessão

    // Verificação se existe a sessão 'logado'
    if(!isset($_SESSION['logado'])):
        header('Location: index.php');
    endif;

    // Captura de dados da sessão

    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";

    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);

    include_once '../includes/header.php';

    if(isset($_GET['id'])){
        $id = mysqli_escape_string($connect, $_GET['id']);
        $sql = "SELECT * FROM usuarios WHERE id = '$id'";
        $resultado = mysqli_query($connect, $sql);
        $dados = mysqli_fetch_array($resultado);
    }

?>

<div class="row no-gutters mt-4">
        <div class="col-12 col-md-8 offset-md-2">
            <h3 class="page-title text-center"><ion-icon name="create-outline"></ion-icon> Editar Usuário</h3>
            <form class="editform" action="../php_action/update-users.php" method="POST">
                <input name="id" type="hidden" value="<?php echo $dados['id'] ?>">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" type="text" name="username" id="username" value="<?php echo $dados['username'] ?>">
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input class="form-control" type="email" name="email" id="email" value="<?php echo $dados['email'] ?>">
                </div>

                <div class="form-group">
                    <label for="login">Login</label>
                    <input class="form-control" type="text" name="login" id="login" value="<?php echo $dados['login'] ?>">
                </div>

                <div class="form-group">
                    <label for="profile">Profile</label>
                    <select class="form-control" name="profile" id="profile">
                        <option selected disabled hidden>Selecione uma unidade</option>
                        <option value="ti" <?php if($dados['profile'] == "ti"){echo 'selected';} ?>>Admin</option>
                        <option value="com" <?php if($dados['profile'] == "com"){echo 'selected';} ?>>Comercial</option>
                        <option value="sac" <?php if($dados['profile'] == "sac"){echo 'selected';} ?>>SAC</option>
                        <option value="adm" <?php if($dados['profile'] == "adm"){echo 'selected';} ?>>Administrativo</option>
                        <option value="ctrl" <?php if($dados['profile'] == "ctrl"){echo 'selected';} ?>>Controladoria</option>
                        <option value="fin" <?php if($dados['profile'] == "fin"){echo 'selected';} ?>>Financeiro</option>
                        <option value="cob" <?php if($dados['profile'] == "cob"){echo 'selected';} ?>>Cobrança</option>
                        <option value="ope" <?php if($dados['profile'] == "ope"){echo 'selected';} ?>>Operacional</option>
                        <option value="ass" <?php if($dados['profile'] == "ass"){echo 'selected';} ?>>Assistência</option>
                        <option value="dp" <?php if($dados['profile'] == "dp"){echo 'selected';} ?>>DP</option>
                        <option value="rh" <?php if($dados['profile'] == "rh"){echo 'selected';} ?>>RH</option>
                        <option value="dir" <?php if($dados['profile'] == "dir"){echo 'selected';} ?>>Diretoria</option>
                        <option value="mnt" <?php if($dados['profile'] == "mnt"){echo 'selected';} ?>>Monitoria</option>
                        <option value="fro" <?php if($dados['profile'] == "fro"){echo 'selected';} ?>>Frota</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="permission">Nível de Permissão</label>
                    <select name="permission" id="permission" class="form-control">
                        <option value="0" <?php if($dados['permission'] == "0"){ echo 'selected';} ?> >0 -> Não permite fazer alterações no Aprenda</option>
                        <option value="1" <?php if($dados['permission'] == "1"){ echo 'selected';} ?>>1 -> Permite fazer alterações no Aprenda</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input class="form-control" type="password" name="password" id="password" value="<?php echo $dados['password'] ?>">
                    <input type="checkbox" onclick="revealPassword()"> Mostrar senha
                </div>

                <div class="form-group mt-3">
                    <button type="submit" name="btn-atualizar" class="btn btn-success"><ion-icon name="cloud-upload-outline"></ion-icon> ATUALIZAR</button>
                    <a href="users-list.php" class="btn btn-primary"><ion-icon name="arrow-back-outline"></ion-icon> VOLTAR</a>
                </div>
            </form>

            <br>
        </div>
    </div>

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

<?php 
    include_once '../includes/footer.php';  
?>