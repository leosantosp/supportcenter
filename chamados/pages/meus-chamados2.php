<?php 
    $titlepage = "Meus chamados | Helpdesk VIPEX";
    include_once '../includes/header.php';

    // session_start();

    // if(!isset($_SESSION['logado'])):
    //     header('Location: index.php');
    // endif;

    // $id = $_SESSION['id_usuario'];
    // $sql = "SELECT * FROM usuarios WHERE id = '$id'";

    // $resultado = mysqli_query($connect, $sql);
    // $infosessao = mysqli_fetch_array($resultado);

?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>

    <h1>Seja bem-vindo </h1>

    <div class="content"> -->
        <div class="col-12">
            <h3 class="title-page">MEUS CHAMADOS</h3>

            <table id="table" class="table table-admin" style="font-size: .9em;">
                <thead class="thead-table thead-dark thead-overview">
                    <tr>
                        <th class="th-title" data-column="id">ID</th>
                        <th class="th-title">Assunto</th>
                        <th class="th-title">Status</th>
                        <th class="th-title">Nível</th>
                        <th class="th-title" data-column="data-abertura">Aberto em</th>
                        <th class="th-title" colspan="6">Ações</th>

                    </tr>
                    <tr>
                        <th class="th-search"><input class="form-control" id="srcClass" type="text"></th>
                        <th class="th-search"></th>
                        <th class="th-search"><input class="form-control" id="srcClass" type="text"></th>
                        <th class="th-search"><input class="form-control" id="srcClass" type="text"></th>
                        <th class="th-search"></th>
                        <th class="th-search"></th>   
                        <th class="th-search"></th>   
                        <th class="th-search"></th>  
                        <th class="th-search"></th>   
                        <th class="th-search"></th>   
                        <th class="th-search"></th>   




                    </tr>
                </thead>

                <tbody class="tbody-table tbody-overview">
                    <?php 


                        $sql = "SELECT * FROM chamados ORDER BY id DESC";
                        $resultado = mysqli_query($connect, $sql);

                        if(mysqli_num_rows($resultado) > 0):

                            while($dados = mysqli_fetch_array($resultado)):
                                if($dados['responsavel'] === $id AND $dados['status'] !== "Finalizado"):

                                    $datafechado = Date('d-m-Y H:i:s', strtotime($dados['fechado']));
                    ?>

                    
                    <tr>
                        <td> <strong> #<?php echo $dados['id'] ?> </strong></td>
                        <td>  
                            <?php 
                                echo str_replace('-', ' ', $dados['assunto'])."  <br>".$dados['username'] 
                            ?>
                        </td>
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
                        <td>
                           <button class="btn btn-nivel <?php echo $dados['nivel']; ?>"><?php echo $dados['nivel'] ?></button>
                        </td>
                        <td><?php echo Date('d/m/Y H:i:s', strtotime($dados['abertura'])) ?></td>
                        
                        
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal<?php echo $dados['id'] ?>">
                            <ion-icon name="reorder-four"></ion-icon> Ver Detalhes
                            </button>
                        </td>
                        <td>
                            <form action="../php_action/update-call.php"  method="POST">
                                <input hidden name="callid" id="callid" value="<?php echo $dados['id'] ?>">
                                <select class="form-control" name="status" id="status">
                                    <option selected disabled>Clique para escolher</option>
                                    <option value="Em andamento">Em andamento</option>
                                    <option value="Aguardando usuario">Aguardando usuário</option>
                                    <option value="Aguardando devolução">Aguardando devolução</option>
                                    <option value="Em analise">Em análise</option>
                                    <option value="Redirecionado">Redirecionado</option>
                                    <option value="Fase de Testes">Fase de Testes</option>
                                    <option value="Finalizado">Finalizado</option>
                                </select>
                            
                                <button name="updateStatus" class="btn btn-success btn-atualizar" type="submit"><ion-icon name="reload-circle"></ion-icon> Atualizar status </button>
                            </form>
                        </td>
                        <td>
                            <form action="../php_action/update-nivel.php"  method="POST">
                                <input hidden name="callid" id="callid" value="<?php echo $dados['id'] ?>">
                                <select class="form-control" name="nivel" id="nivel">
                                    <option selected disabled>Nível</option>
                                    <option value="Baixa">Baixa</option>
                                    <option value="Media">Média</option>
                                    <option value="Alta">Alta</option>
                                    <option value="Critica">Crítica</option>
                                </select>
                            
                                <button name="updateNivel" class="btn btn-secondary btn-atualizar" type="submit"><ion-icon name="create"></ion-icon></button>
                            </form>
                        </td>
                        <!-- <td>
                            <form action="../php_action/get-call.php" method="POST">
                            <input type="hidden" name="callid" id="callid" value="<?php echo $dados['id'] ?>">
                                <select class="form-control" name="responsavelid" id="responsavelid">
                                    <option selected disabled>Responsável</option>
                                    <?php 
                                        $sector = 'ti';
                                        $sqlIT = "SELECT * FROM usuarios WHERE profile = '$sector'";
                                        $resultIT = mysqli_query($connect, $sqlIT);
                                        

                                        while($dadosIT = mysqli_fetch_array($resultIT)):
                                    ?>
                                        <option value="<?php echo $dadosIT['id'] ?>"><?php echo $dadosIT['username'] ?></option>
                                    <?php 
                                        endwhile;
                                    ?>
                                </select>
                                <button name="getCall" class="btn btn-secondary btn-responsavel" type="submit">Trocar</button>
                            </form>
                        </td> -->
                        
                        <td>
                            <button name="callFinish" class="btn btn-danger" type="submit" data-bs-toggle="modal" data-bs-target="#modalFinish<?php echo $dados['id'] ?>">
                            <ion-icon name="checkbox"></ion-icon> Finalizar
                            </button>        
                        </td>
                    </tr>
                    <!-- MODAL DE VER DETALHES DO MODAL -->
                    <div class="modal fade" id="modal<?php echo $dados['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">#<?php echo $dados['id'] ?> - <?php echo $dados['assunto'] ?></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: #FFF;"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Usuário:</strong> <?php echo $dados['username'] ?> <br>
                                <strong>Estabelecimento: </strong> <?php echo $dados['estabelecimento'] ?><br>
                                <strong>Máquina: </strong> <?php echo $dados['pc'] ?><br>
                                <strong>Ramal: </strong> <?php echo $dados['ramal'] ?></p>
                                <br>
                                
                                <p> <strong>Descrição:</strong> <?php echo htmlspecialchars($dados['descricao']); ?> <br><br></p>


                                <span><strong>Anexos:</strong></span><br>
                                <?php 
                                                $arquivosNomes = explode(';', $dados['filename']);

                                                foreach($arquivosNomes as $valor){
                                                    $link = $dados['diretorio'].$valor;

                                                    echo "<a href=".$link." download>$valor</a><br>";
                                                }

                                            ?> <br>
                                <p><strong>Suas observações:</strong><br>
                                    <?php echo $dados['observations']; ?>
                                </p><br>
                                <!-- <form action="../php_action/update-nivel.php"  method="POST">
                                    <input hidden name="callid" id="callid" value="<?php echo $dados['id'] ?>">
                                    <select class="form-control" name="nivel" id="nivel">
                                        <option selected disabled>Nível</option>
                                        <option value="Baixa">Baixa</option>
                                        <option value="Media">Média</option>
                                        <option value="Alta">Alta</option>
                                        <option value="Critica">Crítica</option>
                                    </select>
                            
                                    <button name="updateNivel" class="btn btn-secondary btn-atualizar" type="submit">Atribuir</button>
                                </form> -->


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalResp<?php echo $dados['id'] ?>"><ion-icon name="people"></ion-icon> Trocar responsável </button>
                                <a class="btn btn-primary" href="observations.php?id=<?php echo $dados['id'] ?>"><ion-icon name="pencil"></ion-icon> Minhas observações </a>
                                
                                <a class="btn btn-info" href="comments.php?id=<?php echo $dados['id'] ?>"><ion-icon name="logo-wechat"></ion-icon> Comentários </a>
                                
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- MODAL DE TROCA DE RESPONSÁVEL -->
                    <div class="modal fade" id="modalResp<?php echo $dados['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">#<?php echo $dados['id'] ?> - <?php echo $dados['assunto'] ?></h1>
                                    <button type="button" style="color: #FFF;"class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: #FFF;"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="../php_action/get-call.php" method="POST">
                                    <input type="hidden" name="callid" id="callid" value="<?php echo $dados['id'] ?>">
                                        <select class="form-control" name="responsavelid" id="responsavelid">
                                            <option selected disabled>Escolha um responsável</option>
                                            <?php 
                                                $sector = 'ti';
                                                $sqlIT = "SELECT * FROM usuarios WHERE profile = '$sector'";
                                                $resultIT = mysqli_query($connect, $sqlIT);
                                                

                                                while($dadosIT = mysqli_fetch_array($resultIT)):
                                            ?>
                                                <option value="<?php echo $dadosIT['id'] ?>"><?php echo $dadosIT['username'] ?></option>
                                            <?php 
                                                endwhile;
                                            ?>
                                        </select>
                                    <button name="getCall" class="btn btn-secondary btn-responsavel" type="submit">Trocar responsável</button>
                                    </form>

                                        
                                    
                                </div>
                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL DE FINALIZAÇÃO DE CHAMADO -->
                    <div class="modal fade" id="modalFinish<?php echo $dados['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">#<?php echo $dados['id'] ?> - <?php echo $dados['assunto'] ?></h1>
                                    <button type="button" style="background-color: #FFF;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="../php_action/finish-call.php" method="POST">
                                        <input type="hidden" name="idcall" id="idcall" value="<?php echo $dados['id'] ?>">
                                        <input type="hidden" name="status" id="status" value="Finalizado">
                                        <div class="form-group">
                                            <label for="solucao"> <strong>Detalhamento da Solução</strong></label>
                                            <textarea class="form-control solucao" name="solucao" id="solucao"></textarea>
                                        </div>
                                        
                                        
                                </div>
                                <div class="modal-footer">
                                        <button type="submit" name="callFinish" class="btn btn-danger">Finalizar chamado</button>
                                    </form>

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php 
                            endif;
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

            <div class="legenda">
                <h5 class="title-page">LEGENDA</h5>
                <ul>
                    <li><strong>Em triagem:</strong> Chamado aberto.</li>
                    <li><strong>Em andamento:</strong> Um agente tornou-se o responsável pelo chamado</li>
                    <li><strong>Em análise:</strong> Seu chamado está em análise pelo gestor do T.I</li>
                    <li><strong>Aguardando usuário:</strong> Foi encaminhado alguma mensagem em seu discord ou e-mail sobre o chamado, favor verificar</li>
                    <li><strong>Redirecionado:</strong> Chamado foi redirecionado para terceiros (SIL Sistemas, Frotec, NATIVE, Discord)</li>
                    <li><strong>Fase de Testes:</strong> Necessário realizar testes na plataforma referente a sua solicitação</li>
                    <li><strong>Finalizado:</strong> Chamado concluído</li>
                </ul>
            </div>
        </div>

        
        <script>
            ClassicEditor
            .create(document.querySelectorAll('#solucao'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'bulletedList', '|', 'link'],
                shouldNotGroupWhenFull: false
            })
            .catch(error => {
                console.error(error);
            });


            const columnHeaders = document.querySelectorAll('th[data-column]');

            columnHeaders.forEach(header => {
                header.addEventListener('click', () => {
                    const column = header.getAttribute('data-column');
                });

                sortChamadosByColumn(column);
            });

            function sortChamadosByColumn(column){
                // Obtenha os dados dos chamados da tabela
                const table = document.querySelector('table');
                const tbody = table.querySelector('tbody');
                const rows = Array.from(tbody.querySelectorAll('tr'));

                // Ordene os chamados com base na coluna selecionada
                rows.sort((rowA, rowB) => {
                    const valueA = rowA.querySelector(`td[data-column="${column}"]`).textContent;
                    const valueB = rowB.querySelector(`td[data-column="${column}"]`).textContent;
                    
                    // Realize a comparação entre os valores
                    if (column === 'id') {
                    // Exemplo: Ordenação numérica ascendente
                    return Number(valueA) - Number(valueB);
                    } else if (column === 'data_abertura') {
                    // Exemplo: Ordenação de data ascendente
                    return new Date(valueA) - new Date(valueB);
                    }
                    
                    // Retorne 0 se os valores forem iguais
                    return 0;
                });

                 // Remova as linhas existentes da tabela
                rows.forEach(row => {
                    tbody.removeChild(row);
                });

                // Adicione as linhas ordenadas de volta à tabela
                rows.forEach(row => {
                    tbody.appendChild(row);
                });
            }

        </script>



        <?php 
            include_once '../includes/footer.php';
        ?>
    <!-- </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html> -->