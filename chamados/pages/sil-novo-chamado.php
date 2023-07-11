<?php
        $titlepage = "Novo chamado SIL | Helpdesk VIPEX";
        require_once '../includes/header.php'
    
    ?>
        <div class="container">
            <div class="row">
                <div class="col-12 mt-7">
                    <h2 class="title-page">NOVO CHAMADO SIL SISTEMAS</h2>

                    <form action="../php_action/create-sil-call.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group mt-3">
                            <label for="cardid"><strong>Card ID (Informe apenas o n° do Card)</strong> </label>
                            <input type="number" name="cardid" id="cardid" class="form-control">
                        </div>

                        <div class="form-group mt-3">
                            <label for="aplicativo"> <strong>Aplicativo</strong></label>
                            <select name="aplicativo" id="aplicativo" class="form-control">
                                <option value="SINTRA">SINTRA</option>
                                <option value="SINTRA-Mobile">SIL Track (SINTRA Mobile)</option>
                                <option value="Conferencia-Eletronica">Conferência Eletrônica</option>
                                <option value="PRIMUS">PRIMUS</option>
                                <option value="Business One">Business One</option>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="assunto"><strong>Assunto</strong></label>
                            <input class="form-control" type="text" name="assunto" id="assunto">
                        </div>

                        <div class="form-group mt-3">
                            <label for="nivel"><strong>Nivel (Melhorias e Dúvidas recebem seu proprio status)</strong></label>
                            <select name="nivel" id="nivel" class="form-control">
                                <option disabled selected>Selecione o nível de prioridade </option>
                                <option value="Baixa">Baixa</option>
                                <option value="Media">Média</option>
                                <option value="Alta">Alta</option>
                                <option value="Critica">Crítica</option>
                                <option value="Duvida">Dúvida</option>
                                <option value="Melhoria">Melhoria</option>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="description"><strong>Descrição</strong></label> <br>
                            <span>OBS: Sempre forneça todas as informações. Não faça anexo das imagens por aqui, utilize este campo apenas para texto</span>
                            <textarea style="height: 300px; resize: none;" class="form-control" name="description" id="description" config.entities_latin="false"></textarea>
                        </div>

                        <input type="hidden" name="userid" id="userid" value="<?php echo $dados['id'] ?>">

                        <div class="form-group mt-4">
                            <button type="submit" name="btn-create" class="btn btn-primary">ABRIR CHAMADO SIL</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            ClassicEditor
            .create(document.querySelector('#description'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'bulletedList', '|', 'link'],
                shouldNotGroupWhenFull: false
            })
            .catch(error => {
                console.error(error);
            });

        </script>
    
<?php 
    require_once '../includes/footer.php'
?>