<?php
        $titlepage = "Abertura de Chamado | Helpdesk VIPEX";
        require_once '../includes/header.php';
        
    
    ?>
        <div class="container">
            <div class="row">
                <div class="col-12 mt-7">
                    <h2 class="title-page">NOVO CHAMADO</h2>
                    <p><?php 
                        if($dados['profile'] == 'ti'){
                            echo "Para abrir um chamado detalhado: <a href='abrir-chamado-detalhado.php'>Clique aqui</a>";
                        }
                    ?></p>

                    

                    <form id="open-calls" action="../php_action/create-call.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group mt-3">
                            <label for="assunto"> <strong>Assunto</strong></label>
                            <select name="assunto" id="assunto" class="form-control">
                                <option value="SINTRA">SINTRA</option>
                                <option value="SINTRA-Mobile">SINTRA Mobile</option>
                                <option value="Conferencia-Eletronica">Conferência Eletrônica</option>
                                <option value="Desenvolvimento-Projetos">Desenvolvimentos/Projetos</option>
                                <option value="Frota">Frota</option>
                                <option value="NATIVE">NATIVE</option>
                                <option value="Octadesk">Octadesk</option>
                                <option value="Pagbem">Pagbem</option>
                                <option value="Discord">Discord</option>
                                <option value="Site-VIPEX">Website VIPEX</option>
                                <option value="Ramal-Fisico">Ramal Físico</option>
                                <option value="Ramal-Digital">Ramal Digital</option>
                                <option value="Ramal-Sem-Fio">Ramal Sem-Fio</option>
                                <option value="Smartphone">Smartphone</option>
                                <option value="Impressoras">Impressoras</option>
                                <option value="Email">E-mails</option>
                                <option value="Solic-de-Equipamentos">Solicitação de Equipamentos</option>
                                <option value="Conserto-de-Equipamentos">Conserto de Equipamentos</option>
                                <option value="Servidores">Servidores</option>
                                <option value="Banco-de-Dados">Banco de Dados</option>
                                <option value="Planilha-Robo">Criar planilha robô</option>
                                <option value="Relatorios">Relatorios (Criação/Ajuste)</option>
                                <option value="Ajuste-Planilha-Robo">Ajuste Planilha Robô</option>
                                <option value="Admissao-Demissao">Admissão/Demissão</option>
                                <option value="Portal-do-Cliente">Portal do Cliente</option>
                                <option value="Windows">Windows</option>
                                <option value="Computadores">Computadores</option>
                                <option value="Pacote-Office">Pacote Office</option>
                                <option value="Rede">Rede</option>
                                <option value="Outros">Outros</option>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="description"><strong>Descrição</strong></label> <br>
                            <span>OBS: Sempre forneça todas as informações. Não faça anexo das imagens por aqui, utilize este campo apenas para texto</span>
                            <textarea style="height: 300px; resize: none;" class="form-control" name="description" id="description" config.entities_latin="false"></textarea>
                        </div>

                        <div class="form-group mt-3">
                            <label for="files"><strong>Extensões permitidas</strong> <br> (.jpg, .jpeg, .png, .pdf, .docx, .xlsx, .csv, .xlsb, .xls, .rtf, .doc, .docm)</label><br>
                            <input class="form-control" type="file" multiple name="files[]" id="files">
                        </div>

                        <input type="hidden" name="userid" id="userid" value="<?php echo $dados['id'] ?>">

                        <div class="form-group mt-4">
                            <button id="abrir-chamado" type="submit" name="btn-create" class="btn btn-primary" onclick="disableSubmitButton()">ABRIR CHAMADO</button>
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

            
            function disableSubmitButton() {
                var submitButton = document.getElementById('abrir-chamado');

                submitButton.disabled = true;

                document.getElementById('open-calls').submit();
            }
        </script>
    
<?php 
    require_once '../includes/footer.php'
?>