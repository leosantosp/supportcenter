<?php 
    $titlepage = "SIL Chamados | Helpdesk VIPEX";
    include_once '../includes/header.php';
?>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title-page">CHAMADOS SIL SISTEMAS</h1>
                <p>Aqui ficará listado todos os chamados abertos na SIL Sistemas</p>

                <?php 
                    
                ?>
                <a class="btn btn-success" href="sil-novo-chamado.php">
                    NOVO CHAMADO SIL
                </a>
                <a class="btn btn-primary" href="sil-chamados-finalizados.php">
                    CHAMADOS FINALIZADOS
                </a>
                

                    <table id="table" class="table table-admin mt-3">
                        <thead class="thead-table thead-dark thead-overview">
                            <tr>
                                <th class="th-title">ID</th>
                                <th class="th-title">Assunto</th>
                                <th class="th-title">Status</th>
                                <th class="th-title">Aberto em</th>
                                <th class="th-title"></th>
                                <th class="th-title"></th>
                                <th class="th-title"></th>
                                <th class="th-title"></th>
                            </tr>
                            <tr>
                                <th class="th-search"><input class="form-control" id="srcID" type="text"> </th>
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

                                $sql = "SELECT * FROM chamados_sil WHERE status <> 'Finalizado' ORDER BY card_id DESC";
                                $resultado = mysqli_query($connect, $sql);

                                if(mysqli_num_rows($resultado) > 0):

                                    while($dados = mysqli_fetch_array($resultado)):
                                        

                                            $datafechado = Date('d-m-Y H:i:s', strtotime($dados['fechado']));
                            ?>

                            
                            <tr>
                                <td> <strong> #<?php echo $dados['card_id'] ?> </strong></td>
                                <td><?php echo str_replace('-', ' ', $dados['assunto']); ?></td>
                                <td>
                                    <button class="btn btn-status 
                                    <?php 
                                        if($dados['status'] == "Em triagem"){
                                            echo "btn-em-triagem";
                                        } elseif ($dados['status'] == "Em consultoria"){
                                            echo "btn-em-andamento";
                                        } elseif ($dados['status'] == "Aguardando cliente" OR $dados['status'] == "Aguardando SIL"){
                                            echo "btn-aguardando-responsavel";
                                        } elseif ($dados['status'] == "Em análise"){
                                            echo "btn-em-analise";
                                        } elseif ($dados['status'] == "Aguardando Orçamento"){
                                            echo "btn-aguardando-orcamento";
                                        } elseif ($dados['status'] == "Orçamento em Aprovação"){
                                            echo "btn-orcamento-em-aprovacao";
                                        } elseif ($dados['status'] == "Em desenvolvimento"){
                                            echo "btn-em-desenvolvimento";
                                        } elseif ($dados['status'] == "Homologação"){
                                            echo "btn-homologacao";
                                        } elseif ($dados['status'] == "Gerando versão"){
                                            echo "btn-gerando-versao";
                                        } else if ($dados['status'] == "Finalizado"){
                                            echo "btn-finalizado";
                                        } else if ($dados['status'] == "Fase de Testes" OR $dados['status'] == "Reunião agendada"){
                                            echo "btn-fase-de-testes";
                                        }
                                    ?>">
                                        <?php echo $dados['status'] ?>
                                    </button>
                                </td>
                                    <?php 
                                        $dadosUsuario = $dados['username_id'];
                                        $sqlusuario = "SELECT * FROM usuarios WHERE id = '$dadosUsuario'";
                                        $queryUser = mysqli_query($connect, $sqlusuario);
                                        $resultUser = mysqli_fetch_array($queryUser);

                                    ?>
                                <td>
                                    <?php echo Date('d/m/Y H:i:s', strtotime($dados['abertura'])) ?>
                                </td>
                                <td>
                                    <?php
                                        if($datafechado == "31-12-1969 21:00:00" OR $datafechado == NULL){
                                            echo "";
                                        } else {
                                            echo Date('d/m/Y H:i:s', strtotime($dados['fechado']));
                                        }
                                    ?>
                                </td>
                                
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal<?php echo $dados['id'] ?>">
                                    <ion-icon name="reorder-four"></ion-icon> Ver detalhes
                                    </button>
                                </td>
                                <td>
                                    <form action="../php_action/update-sil-call.php"  method="POST">
                                        <input hidden name="callid" id="callid" value="<?php echo $dados['id'] ?>">
                                        <select class="form-control" name="status" id="status">
                                            <option selected disabled>Clique para escolher</option>
                                            <option value="Em análise">Em análise</option>
                                            <option value="Em consultoria">Em consultoria</option>
                                            <option value="Aguardando cliente">Aguardando cliente</option>
                                            <option value="Aguardando SIL">Aguardando SIL</option>
                                            <option value="Em desenvolvimento">Em desenvolvimento</option>
                                            <option value="Homologação">Homologação</option>
                                            <option value="Reunião agendada">Reunião agendada</option>
                                            <option value="Gerando versão">Gerando versão</option>
                                            <option value="Aguardando Orçamento">Aguardando orçamento</option>
                                            <option value="Orçamento em Aprovação">Orçamento em Aprovação</option>
                                            <option value="Fase de Testes">Fase de Testes</option>
                                            <option value="Finalizado">Finalizado</option>
                                        </select>
                                    
                                        <button name="updateStatus" class="btn btn-success btn-atualizar" type="submit"><ion-icon name="reload-circle"></ion-icon> Atualizar status </button>
                                    </form>
                                </td>
                            </tr>
                            

                            <div class="modal fade" id="modal<?php echo $dados['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">#SIL-<?php echo $dados['card_id'] ?> - <?php echo $dados['assunto'] ?></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: #FFF;"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Chamado: </strong> #<?php echo $dados['chamado_id'] ?></p>
                                        <p><strong>Usuário:</strong> <?php echo $resultUser['username'] ?></p>
                                        <p><strong>Responsável: </strong> <?php echo $dados['responsavel'] ?></p>
                                        <br>
                                        
                                        <p> <strong>Descrição:</strong> <?php echo $dados['descricao'] ?> <br><br><br></p>


                                        <p>
                                            <strong>Última observação em:</strong>
                                            <?php
                                                if($dados['data_observacoes'] != NULL){
                                                    echo Date('d/m/Y H:i:s', strtotime($dados['data_observacoes'])); 
                                                } else {
                                                    echo "";
                                                }
                                            ?>
                                        </p>

                                        <p>
                                            <strong>Observações</strong> <br>
                                            <?php echo $dados['observacoes'] ?>
                                        </p>

                                    </div>
                                    <div class="modal-footer">
                                        <a class="btn btn-info" href="sil-observations.php?id=<?php echo $dados['id'] ?>">Observações</a>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    </div>
                                    </div>
                                </div>
                            </div>


                            <?php 
                                endwhile;
                            else : ?>
                                <tr>
                                    <td class="text-center">Não existem dados para serem exibidos</td>
                                </tr>
                            <?php 
                                endif;
                            ?>
                        </tbody>
                </table>
            </div>
        </div>
    </div>


<?php 
    include_once '../includes/footer.php';
?>