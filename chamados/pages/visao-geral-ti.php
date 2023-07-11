<?php 
    require_once '../includes/header.php';
?>

    <?php 
        $statusDefault = "Em triagem";
        $statusFinish = "Finalizado";
        
        $sqlCall = "SELECT * FROM chamados";
        $queryCall = mysqli_query($connect, $sqlCall);
        
        $sqlOpenCalls = "SELECT * FROM chamados WHERE responsavel is NULL";
        $queryOpenCalls = mysqli_query($connect, $sqlOpenCalls);

        $callsInProgress = "SELECT * FROM chamados WHERE status <> '$statusDefault' AND status <> '$statusFinish'";
        $queryInProgress = mysqli_query($connect, $callsInProgress);

        $callFinish = "SELECT * FROM chamados WHERE status = '$statusFinish'";
        $queryFinish = mysqli_query($connect, $callFinish);
        
        $sqlList = "SELECT * FROM chamados ORDER BY id DESC";
        $queryList = mysqli_query($connect, $sqlList);
    ?>

    <div class="container">
    <h2 class="title-page">DASHBOARD</h2>

        <div class="row">
            <div class="col-12 col-md-4 overview-data">
                <canvas id="myChart3"></canvas>
            </div>
            <div class="col-12 offset-md-2 col-md-6 overview-data">
                <h3></h3>
                <canvas id="myChart2"></canvas>
            </div>
        </div>
        <table class="table" style="margin-top: 45px">
        <thead class="thead thead-overview">
            <tr>
                <th colspan="4">CHAMADOS DO T.I NO GERAL</th>
            </tr>
            <tr>
                <th>Em Aberto</th>
                <th>Em Andamento</th>
                <th>Finalizado</th>
                <th>Total</th>
            </tr>
            
        </thead>
        <tbody class="tbody tbody-overview">
            <tr>
                <td><?php echo mysqli_num_rows($queryOpenCalls); ?></td>
                <td><?php echo mysqli_num_rows($queryInProgress); ?></td>
                <td><?php echo mysqli_num_rows($queryFinish); ?></td>
                <td><?php echo mysqli_num_rows($queryCall); ?></td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <h5 class="title-page">Lista de Chamados</h5>
    <p>Nesta lista contém todos os chamados que não estão com o status de 'Finalizado'</p>

    <table id="table" class="table table-admin">
                <thead class="thead-table thead-dark thead-overview">
                    <tr>
                        <th class="th-title">ID</th>
                        <th class="th-title">Assunto</th>
                        <th class="th-title">Status</th>
                        <th class="th-title">Responsável</th>
                        <th class="th-title">Aberto em</th>
                        <th class="th-title">Fechado em</th>
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

                    </tr>
                </thead>

                <tbody class="tbody-table tbody-overview">
                    <?php 

                        $sql = "SELECT * FROM chamados ORDER BY id DESC";
                        $resultado = mysqli_query($connect, $sql);

                        if(mysqli_num_rows($resultado) > 0):

                            while($dados = mysqli_fetch_array($resultado)):
                                if($dados['username_id'] === $id AND $dados['status'] !== "Finalizado"):

                                    $datafechado = Date('d-m-Y H:i:s', strtotime($dados['fechado']));
                    ?>

                    
                    <tr>
                        <td> <strong> #<?php echo $dados['id'] ?> </strong></td>
                        <td><?php echo $dados['assunto'] ?></td>
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
                        <td>
                            <?php 
                                $dadosResponsavel = $dados['responsavel'];
                                $sqlresponsavel = "SELECT * FROM usuarios WHERE id = '$dadosResponsavel'";
                                $queryResp = mysqli_query($connect, $sqlresponsavel);
                                $resultResp = mysqli_fetch_array($queryResp);

                                if($resultResp == null){
                                    echo "Sem responsável";
                                } else {
                                    echo $resultResp['username'];
                                }
                            
                            ?>
                        </td>
                        <td>
                            <?php echo Date('d/m/Y H:i:s', strtotime($dados['abertura'])) ?>
                        </td>
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
                            <!-- <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $dados['id']?>" aria-expanded="false" aria-controls="collapseExample">
                                Ver detalhes 
                            </button> -->
                        </td>
                    </tr>
                    <!-- <tr>
                        <td>
                            <div class="collapse" id="collapse<?php echo $dados['id']?>">
                                <div class="card card-body">
                                    <span><strong>Descrição:</strong></span>
                                    <?php echo $dados['descricao'] ?>

                                    <br><br>
                                    <span><strong>Anexos:</strong></span> <?php 
                                                $arquivosNomes = explode(';', $dados['filename']);

                                                foreach($arquivosNomes as $valor){
                                                    $link = $dados['diretorio'].$valor;

                                                    echo "<a href=".$link." download>$valor</a><br>";
                                                }

                                            ?>
                                </div>
                            </div>
                        </td>
                    </tr> -->

                    <div class="modal fade" id="modal<?php echo $dados['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">#<?php echo $dados['id'] ?> - <?php echo $dados['assunto'] ?></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Usuário:</strong> <?php echo $dados['username'] ?></p>
                                <p><strong>Estabelecimento: </strong> <?php echo $dados['estabelecimento'] ?></p>
                                <p><strong>Máquina: </strong> <?php echo $dados['pc'] ?></p>
                                <p><strong>Ramal: </strong> <?php echo $dados['ramal'] ?></p>
                                <br>
                                
                                <p> <strong>Descrição:</strong> <?php echo $dados['descricao'] ?> <br><br><br></p>


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



    

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx2 = document.getElementById('myChart2');

new Chart(ctx2, {
  type: 'bar',
  data: {
    labels: ['Em aberto', 'Em andamento', 'Finalizados'],
    datasets: [{
      label: 'Chamados Finalizados',
      data: [
          <?php 
              echo mysqli_num_rows($queryOpenCalls).", ".mysqli_num_rows($queryInProgress).", ".mysqli_num_rows($queryFinish);
          ?>
      ],
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});

const ctx3 = document.getElementById('myChart3');

new Chart(ctx3, {

  type: 'doughnut',
  data: {
      labels: [
          'Em Aberto',
          'Em Andamento',
          'Finalizados'
      ],
      datasets: [{
          label: 'Overview Chamados',
          data: [ <?php echo mysqli_num_rows($queryOpenCalls).", ".mysqli_num_rows($queryInProgress).", ".mysqli_num_rows($queryFinish) ?>],
          backgroundColor: [
          'rgb(255, 99, 132)',
          'rgb(54, 162, 235)',
          'rgb(255, 205, 86)'
          ],
          hoverOffset: 4
      }]
  }
});
    </script>

<?php 
    require_once '../includes/footer.php';
?>