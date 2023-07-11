<?php 
    $titlepage = "SIL Observações | Helpdesk VIPEX";
    include_once '../includes/header.php';

    if(isset($_GET['id'])){

        $id = mysqli_escape_string($connect, $_GET['id']);
        $sql = "SELECT * FROM chamados_sil WHERE id = '$id'";

        $resultado = mysqli_query($connect, $sql);
        $dados = mysqli_fetch_array($resultado);
    }

?>

<div class="row no-gutters mt-4">
    <div class="col-12 col-md-8 offset-md-2">
        <h3 class="text-center title-page">Inserir observações no chamado <br> #SIL-<?php echo $dados['card_id']." - ".$dados['assunto'] ?></h3>

        <form action="../php_action/update-sil-observations.php" method="POST">
            <input name="callid" type="hidden" value="<?php echo $dados['id'] ?>">

            <div class="form-group mt-3">
                <label for="chamadoid"> <strong>Chamado ID</strong></label>
                <input type="number" class="form-control" name="chamadoid" id="chamadoid" value="<?php echo $dados['chamado_id'] ?>"> 
            </div>

            <div class="form-group mt-3">
                <label for="responsavel"> <strong>Responsável</strong></label>
                <input class="form-control" type="text" name="responsavel" id="responsavel" value="<?php echo $dados['responsavel'] ?>" placeholder="Ex: Karina Fujisawa">
            </div>
            <div class="form-group mt-3">
                <label for="observations"><strong>Observações</strong></label> <br>
                <span>OBS: Sempre forneça todas as informações. Não faça anexo das imagens por aqui, utilize este campo apenas para texto</span>
                <div class="editor-container" style="width: 100%; height: 350px;">
                    <textarea style="height: 300px; resize: none;" class="form-control" name="observations" id="observations" config.entities_latin="false"><?php echo $dados['observacoes'] ?></textarea>
                </div>
            </div>

            <div class="form-group mt-4">
                <button class="btn btn-primary btn-login" type="submit" name="btn-observations">ATUALIZAR INFORMAÇÕES</button>
            </div>

        </form>
    </div>
</div>

        <script>
            ClassicEditor
            .create(document.querySelector('#observations'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'bulletedList', '|', 'link'],
                shouldNotGroupWhenFull: false
            })
            .catch(error => {
                console.error(error);
            });

        </script>
<?php 
    include_once '../includes/footer.php';
?>