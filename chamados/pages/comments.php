<?php 
    $titlepage = "Comentários | Helpdesk VIPEX";
    include_once '../includes/header.php';

    if(isset($_GET['id'])){

        $callid = mysqli_escape_string($connect, $_GET['id']);
        $queryCall = "SELECT * FROM chamados WHERE id = '$callid'";

        $resultCall = mysqli_query($connect, $queryCall);
        $calldata = mysqli_fetch_array($resultCall);
    }

    $logadoid = $_SESSION['id_usuario'];

?>

<div class="row no-gutters">
    <div class="col-12 col-md-6 chat">
        <?php 
                if($dados['profile'] == 'ti'){
                    echo "<a class='btn btn-secondary' href='meus-chamados.php'><ion-icon name='arrow-back-outline'></ion-icon> Voltar</a><br>";
                } else {
                    echo "<a class='btn btn-secondary' href='list-chamados.php'><ion-icon name='arrow-back-outline'></ion-icon> Voltar</a><br>";
                }
            
            ?>
        <div class="chat-header col-12">
            <h2 class="title-page" style='margin-top: 25px;'>CHAT</h2>
        </div>
        <div class="chat-list col-12">
            <div class="row no-gutters" style="width:100%">

            <div class="chat-messages">
            <?php 
                $sqlChat = "SELECT * FROM chamados_comentarios WHERE chamado_id='$callid' ORDER BY envio ASC";
                $resultChat = mysqli_query($connect, $sqlChat);

                


                if(mysqli_num_rows($resultChat) > 0):
                while($dadosChat = mysqli_fetch_array($resultChat)):

            ?>
                
                <div class="chat-box col-12 col-md-6 mt-2 <?php if($dadosChat['responsavel_id'] == $logadoid OR $dadosChat['agente_id'] == $logadoid){ echo "offset-md-6 chat-align";} else{ echo "chat-other";}?> ">
                    <div class="chat-header">
                        <span class="send-hour">
                            
                                <?php echo Date('d/m/Y H:i:s', strtotime($dadosChat['envio'])); ?>
                            
                        </span>
                        <span class="send-name">
                            <strong>
                            <?php 
                            if($dadosChat['responsavel_id'] == 0){
                                $agente_id = $dadosChat['agente_id'];
                                $sqlAgent = "SELECT * FROM usuarios WHERE id = $agente_id";
                                $executeAgent = mysqli_query($connect, $sqlAgent);
                                $resultAgent = mysqli_fetch_array($executeAgent);
                                echo strtoupper($resultAgent['username']);
                            
                            } else if($dadosChat['agente_id'] == 0){
                                $resp_id = $dadosChat['responsavel_id'];
                                $sqlResp = "SELECT * FROM usuarios WHERE id = $resp_id";
                                $executeResp = mysqli_query($connect, $sqlResp);
                                $resultResp = mysqli_fetch_array($executeResp);
                                echo strtoupper($resultResp['username']);
                            }
                        ?>
                            </strong>
                        </span>
                        
                    </div>    
                    <div class="chat-body">
                        <p><?php echo $dadosChat['comentario'] ?></p>
                    </div>
                </div>
            <?php 
            
                endwhile;
                else:
            ?>
                <p style="text-align: center">Não existem comentários para serem exibidos</p>
            <?php 
                endif;
            ?>
            </div>
            <form class="mt-5" action="../php_action/create-comment.php" method="POST">
            <h5 class="title-page">Deixe aqui seu comentário  </h5>

                <input type="hidden" name="callid" value="<?php echo $callid ?>">
                <?php 
                    if($logadoid == $calldata['responsavel']){
                        $respid = $logadoid;
                        $userid = '';
                    }
                    else if($logadoid == $calldata['username_id']){
                        $respid = '';
                        $userid = $logadoid;
                    }
                ?>
                <input type="hidden" name="respid" value="<?php echo $respid ?>">
                <input type="hidden" name="userid" value="<?php echo $userid ?>">

                <textarea name="comment" id="comment" class="form-control"></textarea>
                <div class="form-group">
                    <button class="btn btn-primary btn-sendcomment mt-3" type="submit" name="send-comment">ENVIAR COMENTÁRIO <ion-icon name="send"></ion-icon></button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 callinfo">
        <div class="callinfo-header">
            <h3 class="title-page">#<?php echo $calldata['id']." - ". str_replace('-', ' ', $calldata['assunto']); ?></h3>
            <span> <strong>Data de Abertura:</strong> <?php echo Date('d/m/Y H:i:s', strtotime($calldata['abertura'])); ?></span>
        </div>
        <div class="callinfo-body">
            <h6 class="title-page">INFORMAÇÕES DO SOLICITANTE</h6>
            <ul>
                <li><strong class="title-page">Nome: </strong> <?php echo $calldata['username'] ?></li>
                <li><strong class="title-page">Estabelecimento: </strong> <?php echo $calldata['estabelecimento'] ?></li>
                <li><strong class="title-page">Máquina: </strong> <?php echo $calldata['pc'] ?></li>
                <li><strong class="title-page">Ramal: </strong> <?php echo $calldata['ramal'] ?></li>
                <li><strong class="title-page">E-mail: </strong> <?php echo $calldata['email'] ?></li>
            </ul> 
            <br>
            <h6 class="title-page">INFORMAÇÕES DO CHAMADO</h6>
            <p >
                <strong class="title-page" >Descrição: </strong> <br>
                <?php echo $calldata['descricao']; ?>
            </p>
            <span><strong>Anexos:</strong></span><br>
            <?php 
                    $arquivosNomes = explode(';', $calldata['filename']);

                    foreach($arquivosNomes as $valor){
                        $link = $calldata['diretorio'].$valor;

                        echo "<a href=".$link." download>$valor</a> <br>";
                    }
            ?>
        </div>
    </div>
</div>

<script>
            ClassicEditor
            .create(document.querySelector('#comment'), {
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