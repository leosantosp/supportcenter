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
            <h3>Novo Tutorial</h3>
            <form action="../php_action/create-tutorial.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="class">Classificação</label>
                    <select required name="class" id="class" class="form-control">
                        <option hidden selected disabled>Selecione uma classificação</option>
                        <option value="GERAL">GERAL</option>
                        <option value="ADM">ADM</option>
                        <option value="COM/SAC">COM / SAC</option>
                        <option value="RH">RH</option>
                        <option value="DP">DP</option>
                        <option value="OPE/ASS">OPERACIONAL / ASSISTÊNCIA</option>
                        <option value="FIN">FINANCEIRO</option>
                        <option value="TI">TI</option>
                        <option value="COB">COBRANÇA</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Digite o título do tutorial">
                </div>

                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea name="description" id="description"></textarea>
                </div>

                <div class="form-group">
                    <label for="file">Arquivo</label>
                    <input class="form-control" type="file" name="file" id="file">
                </div>

                <div class="form-group mt-3">
                    <button type="submit" name="btn-cadastrar" class="btn btn-success">Cadastrar</button>
                    <a href="tutorials-list.php" class="btn btn-primary">Voltar</a>
                </div>
            </form>

            <br>
        </div>
    </div>

    <script>
        CKEDITOR.replace('description');
    </script>
<?php 
    include_once '../includes/footer.php';
?>