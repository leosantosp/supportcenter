<?php 
    // Conexão
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

    if(isset($_GET['id'])){
        // Pegar o ID que foi passado via URL
        $id = mysqli_escape_string($connect, $_GET['id']);

        $sql = "SELECT * FROM tutoriais WHERE id = '$id'";

        // Executar a Query e atribuir o resultado em $resultado
        $resultado = mysqli_query($connect, $sql);

        // Atribuir os valores das arrays em $dado;
        $dados = mysqli_fetch_array($resultado);
    }
?>

<div class="row no-gutters mt-4">
        <div class="col-12 col-md-8 offset-md-2">
            <h3 class="page-title text-center">EDITAR TUTORIAL</h3>
            <form class="form-admin" action="../php_action/update-tutorial.php" method="POST" enctype="multipart/form-data">
                <input name="id" type="hidden" value="<?php echo $dados['id'] ?>">

                <div class="form-group">
                    <label for="department">Departamento</label>
                    <select class="form-control" name="class" id="class">
                        <option <?php if($dados['class'] == "") {echo "selected";} ?> hidden selected disabled>Selecione uma classificação</option>
                        <option <?php if($dados['class'] == "GERAL") {echo "selected";} ?> value="GERAL">GERAL</option>
                        <option <?php if($dados['class'] == "ADM") {echo "selected";} ?> value="ADM">ADM</option>
                        <option <?php if($dados['class'] == "COM/SAC") {echo "selected";} ?> value="COM/SAC">COM / SAC</option>
                        <option <?php if($dados['class'] == "RH") {echo "selected";} ?> value="RH">RH</option>
                        <option <?php if($dados['class'] == "DP") {echo "selected";} ?> value="DP">DP</option>
                        <option <?php if($dados['class'] == "OPE/ASS") {echo "selected";} ?> value="OPE/ASS">OPERACIONAL / ASSISTÊNCIA</option>
                        <option <?php if($dados['class'] == "FIN") {echo "selected";} ?> value="FIN">FINANCEIRO</option>
                        <option <?php if($dados['class'] == "TI") {echo "selected";} ?> value="TI">TI</option>
                        <option <?php if($dados['class'] == "COB") {echo "selected";} ?> value="COB">COBRANÇA</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="title">Título</label>
                    <input class="form-control" type="text" name="title" id="title" value="<?php echo $dados['title'] ?>">
                </div>

                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea class="form-control" name="description" id="description"><?php echo $dados['description'] ?></textarea>
                </div>

                <div class="form-group">
                    <label for="file">Arquivo</label>
                    <input class="form-control" type="file" name="file" id="file">
                </div>

                <div class="form-group mt-3">
                    <button type="submit" name="btn-atualizar" class="btn btn-success">ATUALIZAR</button>
                    <a href="tutorials-list.php" class="btn btn-primary">VOLTAR</a>
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