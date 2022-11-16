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
                        <option disabled hidden>Selecione um profile</option>
                        <option <?php if($dados['profile'] == "admin") {echo "selected";} ?> value="admin">Admin</option>
                        <option <?php if($dados['profile'] == "user") {echo "selected";} ?> value="user">User</option>
                        <option <?php if($dados['profile'] == "author") {echo "selected";} ?> value="author">Author</option>
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