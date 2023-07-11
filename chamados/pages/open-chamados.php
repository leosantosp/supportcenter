<?php 
    $titlepage = "Chamados em Aberto | Helpdesk VIPEX";
    include_once '../includes/header.php';

?>
        <div class="col-12">
            <h3  class="title-page">Chamados em Aberto</h3>
            <p>Aqui estão listados todos os chamados abertos que não possuem um responsável atribuído</p>

            <table id="table" class="table table-admin">
                <thead class="thead-table thead-dark thead-overview">
                    <tr>
                        <th class="th-title">ID</th>
                        <th class="th-title">Assunto</th>
                        <th class="th-title">Status</th>
                        <th class="th-title">Responsável</th>
                        <th class="th-title">Aberto em</th>
                        <th class="th-title">Fechado em</th>
                        <th colspan="3"  class="th-title text-center">Ações</th>
                    </tr>
                    <tr>
                        <th class="th-search"> </th>
                        <th class="th-search"><input class="form-control" id="srcDescription" type="text"></th>
                        <th class="th-search"><input class="form-control" id="srcClass" type="text"></th>
                        <th class="th-search"></th>
                        <th class="th-search"></th>  
                        <th class="th-search"></th>    
                        <th class="th-search"></th>    
                        <th class="th-search"></th>    


                    </tr>
                </thead>

                <tbody class="tbody-table tbody-overview">
                    <?php 

                        $sql = "SELECT * FROM chamados WHERE responsavel is NULL OR responsavel = ''";
                        $resultado = mysqli_query($connect, $sql);

                        if(mysqli_num_rows($resultado) > 0):

                            while($dados = mysqli_fetch_array($resultado)):
                                $datafechado = Date('d-m-Y H:i:s', strtotime($dados['fechado']));
                    ?>

                    
                    <tr>
                        <td> <strong> #<?php echo $dados['id'] ?> </strong></td>
                        <td><?php echo str_replace('-', ' ', $dados['assunto'])."<br>".$dados['username'] ?></td>
                        <td> 
                            <button class="btn btn-status 
                            <?php 
                                    if($dados['status'] == "Em triagem"){
                                        echo "btn-em-triagem";
                                    } elseif ($dados['status'] == "Em andamento"){
                                        echo "btn-em-andamento";
                                    } elseif ($dados['status'] == "Aguardando usuario"){
                                        echo "btn-aguardando-usuario";
                                    } elseif ($dados['status'] == "Aguardando responsavel"){
                                        echo "btn-aguardando-responsavel";
                                    } elseif ($dados['status'] == "Aguardando devolução"){
                                        echo "btn-aguardando-usuario";
                                    } elseif ($dados['status'] == "Redirecionado"){
                                        echo "btn-redirecionado";
                                    } elseif ($dados['status'] == "Em analise"){
                                        echo "btn-em-analise";
                                    } else if ($dados['status'] == "Finalizado"){
                                        echo "btn-finalizado";
                                    } else if ($dados['status'] ==  "Fase de Testes"){
                                        echo "btn-fase-de-testes";
                                    }
                                ?>">
                                <?php echo $dados['status'] ?> 
                            </button>
                        </td>
                        <td><?php echo $dados['responsavel'] ?></td>
                        <td><?php echo Date('d/m/Y H:i:s', strtotime($dados['abertura'])) ?></td>
                        <td><?php
                            if($datafechado == "31-12-1969 21:00:00"){
                                echo "";
                            } else {
                                echo Date('d/m/Y H:i:s', strtotime($dados['fechado']));
                            }

                         ?>
                         </td>
                        
                        <td>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal<?php echo $dados['id'] ?>">
                                Ver detalhes
                            </button>
                        </td>
                        <td>
                            <form action="../php_action/get-call.php" method="POST">
                                <input type="hidden" name="callid" id="callid" value="<?php echo $dados['id'] ?>">
                                <input type="hidden" name="responsavelid" id="responsavelid" value="<?php echo $id ?>">
                                <button class="btn btn-primary" type="submit" name="getCall">
                                <ion-icon name="finger-print"></ion-icon> Atribuir a mim
                                </button>
                            </form>
                        </td>
                    </tr>
                    <div class="modal fade" id="modal<?php echo $dados['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">#<?php echo $dados['id'] ?> - <?php echo str_replace('-', ' ', $dados['assunto']);  ?></h1>
                                <button type="button" style="background-color: #FFF;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Usuário:</strong> <?php echo $dados['username'] ?></p>
                                <p><strong>Estabelecimento: </strong> <?php echo $dados['estabelecimento'] ?></p>
                                <p><strong>Máquina: </strong> <?php echo $dados['pc'] ?></p>
                                <p><strong>Ramal: </strong> <?php echo $dados['ramal'] ?></p>
                                <p><strong>E-mail: </strong> <?php echo $dados['email'] ?></p>
                                <br>

                                <?php 
                                    $descSubstituido = preg_replace("/<table>(.*?)<\/table>/is","<ul class='table-user' style='padding:0;'>$1</ul>", $dados['descricao']);
                                    $descThead = str_replace('<thead>',"<div class='table-thead' style='padding:0; background-color:#A6A6A6'>", $descSubstituido);
                                    $descThead2 = str_replace('</thead>', "</div>", $descThead);
                                    $descTbody = str_replace('<tbody>', "<div class='table-body' style='padding:0; background-color:#D9D9D9'>", $descThead2);
                                    $descTbody2 = str_replace('</tbody>', "</div>", $descTbody);
                                    $descTr = str_replace('<tr>', "<li style='padding:0'>", $descTbody2);
                                    $descTr2 = str_replace('</tr>', '</li>', $descTr);
                                    $descTh = str_replace('<th>', "<span class='cell'>", $descTr2);
                                    $descTh2 = str_replace('</th>', '</span>&nbsp;&nbsp;|&nbsp;&nbsp;', $descTh);
                                    $descTd = str_replace('<td>', "<span class='cell'>", $descTh2);
                                    $descFinal = str_replace('</td>', '</span>&nbsp;&nbsp;|&nbsp;&nbsp;', $descTd);
                                ?>
                                
                                <p> <strong>Descrição:</strong><br><?php echo $descFinal ?> <br><br><br></p>


                                <span><strong>Anexos:</strong></span><br>
                                <?php 
                                                $arquivosNomes = explode(';', $dados['filename']);

                                                foreach($arquivosNomes as $valor){
                                                    $link = $dados['diretorio'].$valor;

                                                    echo "<a href=".$link." download>$valor</a><br>";
                                                }

                                            ?>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            </div>
                            </div>
                        </div>
                    </div>


                    <?php 
                         endwhile;
                    else : ?>
                        <tr>
                            <td colspan="8" class="text-center">Não existem dados para serem exibidos</td>
                        </tr>
                    <?php 
                        endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php 
    
        include_once '../includes/footer.php';
    ?>