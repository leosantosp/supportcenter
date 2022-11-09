<?php 
    include_once '../php_action/db_connect.php';

    session_start();

    /**
     * Verificação
     */

    if(!isset($_SESSION['logado'])):
        header('Location: index.php');    
    endif;

    /**
     * Captura de dados da sessão
     */

    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";

    $resultado = mysqli_query($connect, $sql);

    $dados = mysqli_fetch_array($resultado);

    include_once '../includes/header.php';
?>

    <div class="row no-gutters">
        <div class="col-12 col-md-8 offset-md-2">
            <h3>Cadastrar novo status SINTRA</h3>
            <form action="../php_action/create-errors.php" method="POST">
                <div class="form-group">
                    <label for="status">Status</label>
                    <input class="form-control" type="text" name="status" id="status">
                </div>

                <div class="form-group">
                    <label for="description">Descrição</label>
                    <input class="form-control" type="text" name="description" id="description">
                </div>

               <div class="form-group">
                    <label for="solution">Resolução</label>
                    <textarea name="solution" id="solution"></textarea>
               </div>

                <div class="form-group mt-3">
                    <button type="submit" name="btn-cadastrar" class="btn btn-success">Cadastrar</button>
                    <a href="errors-list.php" class="btn btn-primary">Voltar</a>
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