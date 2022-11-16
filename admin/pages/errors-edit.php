<?php

    include_once '../php_action/db_connect.php';

    session_start();

    // Verificação
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
        $sql = "SELECT * FROM errors WHERE id = '$id'";

        $resultado = mysqli_query($connect,$sql);
        $dados = mysqli_fetch_array($resultado);
    }

?>

<div class="row no-gutters mt-4">
        <div class="col-12 col-md-8 offset-md-2">
            <h3 class="page-title text-center">Editar Status Sintra</h3>
            <form class="form-admin" action="../php_action/update-errors.php" method="POST">
                <input name="id" type="hidden" value="<?php echo $dados['id'] ?>">
                <div class="form-group">
                    <label for="status">Status</label>
                    <input class="form-control" type="text" name="status" id="status" value="<?php echo $dados['status'] ?>">
                </div>

                <div class="form-group">
                    <label for="description">Descrição</label>
                    <input class="form-control" type="text" name="description" id="description" value="<?php echo $dados['description'] ?>">
                </div>

                <div class="form-group">
                    <label for="solution">Resolução</label>
                    <textarea name="solution" id="solution"><?php echo $dados['solution'] ?></textarea>
                </div>

                
                <div class="form-group mt-3">
                    <button type="submit" name="btn-atualizar" class="btn btn-success">ATUALIZAR</button>
                    <a href="errors-list.php" class="btn btn-primary">VOLTAR</a>
                </div>
            </form>

            <br>
        </div>
    </div>

    <script>
        CKEDITOR.replace('solution');
    </script>

<?php 
    include_once '../includes/footer.php';  
?>