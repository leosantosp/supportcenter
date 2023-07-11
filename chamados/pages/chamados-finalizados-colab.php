<?php 
    $titlepage = "Meus chamados finalizados | Helpdesk VIPEX";

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
            <h3 class="title-page">Chamados Finalizados</h3>

            <table id="table" class="table table-admin">
                <thead class="thead-table thead-dark thead-overview">
                    <tr>
                        <th class="th-title">ID</th>
                        <th class="th-title">Assunto</th>
                        <th class="th-title">Status</th>
                        <th class="th-title">Aberto em</th>
                        <th class="th-title">Fechado em</th>
                        <th class="th-title">Detalhes</th>

                    </tr>
                    <tr>
                        <th class="th-search"> </th>
                        <th class="th-search"><input class="form-control" id="srcDescription" type="text"></th>
                        <th class="th-search"><input class="form-control" id="srcClass" type="text"></th>
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
                                if($dados['username_id'] === $id AND $dados['status'] == "Finalizado"):

                                    $datafechado = Date('d-m-Y H:i:s', strtotime($dados['fechado']));
                    ?>

                    
                    <tr>
                        <td> <strong> #<?php echo $dados['id'] ?> </strong></td>
                        <td><?php echo str_replace('-', '', $dados['assunto']); ?></td>
                        <td>
                        <button class="btn btn-status  
                            <?php 
                                if($dados['status'] == "Em triagem"){
                                    echo "btn-em-triagem";
                                } elseif ($dados['status'] == "Em andamento"){
                                    echo "btn-em-andamento";
                                } elseif ($dados['status'] == "Aguardando usuario"){
                                    echo "btn-aguardando-usuario";
                                } elseif ($dados['status'] == "Redirecionado"){
                                    echo "btn-redirecionado";
                                } elseif ($dados['status'] == "Em analise"){
                                    echo "btn-em-analise";
                                } else if ($dados['status'] == "Finalizado"){
                                    echo "btn-finalizado";
                                }
                            ?>">
                                <?php echo $dados['status'] ?>
                            </button>
                        </td>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal<?php echo $dados['id'] ?>">
                                Ver detalhes
                            </button>
                        </td>
                        
                       
                        
                    </tr>
                    <div class="modal fade" id="modal<?php echo $dados['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">#<?php echo $dados['id'] ?> - <?php echo str_replace('-', '', $dados['assunto'])  ?></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                
                                <p> <strong>Descrição:</strong> <?php echo $descFinal ?> <br><br><br></p>


                                <span><strong>Anexos:</strong></span><br>
                                <?php 
                                                $arquivosNomes = explode(';', $dados['filename']);

                                                foreach($arquivosNomes as $valor){
                                                    $link = $dados['diretorio'].$valor;

                                                    echo "<a href=".$link." download>$valor</a><br>";
                                                }

                                            ?>
                                <p><strong>Detalhamento da Solução aplicada pela T.I</strong><br>
                                    <?php echo $dados['solucao']; ?>
                                </p>

                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-info" href="comments.php?id=<?php echo $dados['id'] ?>"><ion-icon name="logo-wechat"></ion-icon> Comentários </a>
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
        </div>

        <?php 
            include_once '../includes/footer.php';
        ?>
    <!-- </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html> -->