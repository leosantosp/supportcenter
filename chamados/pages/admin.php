<?php 
    $titlepage = "Dashboard | Helpdesk VIPEX";
    require_once '../includes/header.php';
?>
    <?php 
        $statusDefault = "Em triagem";
        $statusFinish = "Finalizado";
        
        $sqlCall = "SELECT * FROM chamados WHERE responsavel = ".$dados['id']."";
        $queryCall = mysqli_query($connect, $sqlCall);
        
        $sqlOpenCalls = "SELECT * FROM chamados WHERE responsavel is NULL";
        $queryOpenCalls = mysqli_query($connect, $sqlOpenCalls);

        $callsInProgress = "SELECT * FROM chamados WHERE responsavel = ".$dados['id']." AND status <> '$statusFinish'";
        $queryInProgress = mysqli_query($connect, $callsInProgress);

        $callFinish = "SELECT * FROM chamados WHERE responsavel = ".$dados['id']." AND status = '$statusFinish'";
        $queryFinish = mysqli_query($connect, $callFinish);

        $queryAgent01 = "SELECT * FROM chamados WHERE responsavel=1 AND status <> 'Finalizado'";
        $queryAgent02 = "SELECT * FROM chamados WHERE responsavel=2 AND status <> 'Finalizado' ";
        $queryAgent03 = "SELECT * FROM chamados WHERE responsavel=3 AND status <> 'Finalizado' ";
        $queryAgent04 = "SELECT * FROM chamados WHERE responsavel=17 AND status <> 'Finalizado' ";

        $finishAgent01 = "SELECT * FROM chamados WHERE responsavel = 1 AND status = 'Finalizado'";
        $finishAgent02 = "SELECT * FROM chamados WHERE responsavel =2 AND status = 'Finalizado'";
        $finishAgent03 = "SELECT * FROM chamados WHERE responsavel = 3 AND status = 'Finalizado'";
        $finishAgent04 = "SELECT * FROM chamados WHERE responsavel = 17 AND status = 'Finalizado'";

        $emAberto = "SELECT * FROM chamados WHERE responsavel is NULL";
        $emAndamento = "SELECT * FROM chamados WHERE status <> 'Finalizado' AND status <> 'Em triagem'";
        $finalizados = "SELECT * FROM chamados WHERE status = 'Finalizado'";
        $executeEmAberto = mysqli_query($connect, $emAberto);
        $executeEmAndamento = mysqli_query($connect, $emAndamento);
        $executeFinalizados = mysqli_query($connect, $finalizados);

        $countEmAberto = mysqli_num_rows($executeEmAberto);
        $countEmAndamento = mysqli_num_rows($executeEmAndamento);
        $countFinalizados = mysqli_num_rows($executeFinalizados);

        $call_null = "SELECT * FROM chamados WHERE nivel is NULL AND responsavel=".$dados['id']."";
        $call_low = "SELECT * FROM chamados WHERE nivel = 'Baixa' AND responsavel=".$dados['id']."";
        $call_medium = "SELECT * FROM chamados WHERE nivel = 'Media' AND responsavel=".$dados['id']."";
        $call_high = "SELECT * FROM chamados WHERE nivel = 'Alta' AND responsavel=".$dados['id']."";
        $call_critical = "SELECT * FROM chamados WHERE nivel = 'Critica' AND responsavel=".$dados['id']."";

        $executeCallNull = mysqli_query($connect, $call_null);
        $executeCallLow = mysqli_query($connect, $call_low);
        $executeCallMedium = mysqli_query($connect, $call_medium);
        $executeCallHigh = mysqli_query($connect, $call_high);
        $executeCallCritical = mysqli_query($connect, $call_critical);

        $countCallNull = mysqli_num_rows($executeCallNull);
        $countCallLow = mysqli_num_rows($executeCallLow);
        $countCallMedium = mysqli_num_rows($executeCallMedium);
        $countCallHigh = mysqli_num_rows($executeCallHigh);
        $countCallCritical = mysqli_num_rows($executeCallCritical);


        $queryUsers = "SELECT * FROM usuarios WHERE profile='ti'";

        $executeUsers = mysqli_query($connect, $queryUsers);
        $executeAgent01 = mysqli_query($connect, $queryAgent01);
        $executeAgent02 = mysqli_query($connect, $queryAgent02);
        $executeAgent03 = mysqli_query($connect, $queryAgent03);
        $executeAgent04 = mysqli_query($connect, $queryAgent04);

        $executeFAgent01 = mysqli_query($connect, $finishAgent01);
        $executeFAgent02 = mysqli_query($connect, $finishAgent02);
        $executeFAgent03 = mysqli_query($connect, $finishAgent03);
        $executeFAgent04 = mysqli_query($connect, $finishAgent04);


        $countCallsAgent01 = mysqli_num_rows($executeAgent01);
        $countCallsAgent02 = mysqli_num_rows($executeAgent02);
        $countCallsAgent03 = mysqli_num_rows($executeAgent03);
        $countCallsAgent04 = mysqli_num_rows($executeAgent04);

        $countFinishAgent01 = mysqli_num_rows($executeFAgent01);
        $countFinishAgent02 = mysqli_num_rows($executeFAgent02);
        $countFinishAgent03 = mysqli_num_rows($executeFAgent03);
        $countFinishAgent04 = mysqli_num_rows($executeFAgent04);

        $resultUsers = mysqli_fetch_array($executeUsers);
        
    ?>
    
    

    <div class="container">
    <h2 class="title-page" style="text-align: center;">DASHBOARD</h2>
    
    <div class="row">
        <div class="col-12 col-md-4 overview-data">
            <h3 class="title-page">OVERVIEW</h3>

            <canvas id="myChart3"></canvas>
        </div>
        <div class="col-12 offset-md-2 col-md-6 overview-finish-by-agent">
            <h3 class="title-page">FINALIZADOS POR AGENTE</h3>
            <canvas id="myChart2"></canvas>
        </div>
    </div>

    <!-- Esta tabela trás a quantidade em valores dos chamados abertos, em progresso, finalizados e a quantidade total -->
    <div class="row" style="margin-top: 76px">
        <div class="col-12">
            <table class="table">
                <thead class="thead thead-overview">
                    <tr>
                        <th colspan="4">STATUS DOS CHAMADOS DO AGENTE LOGADO</th>
                    </tr>
                    <tr>
                        <th>Em Aberto</th>
                        <th>Em Andamento</th>
                        <th>Finalizado</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody class="tbody tbody-overview">
                    <tr class="tr-overview">
                        <td><?php echo mysqli_num_rows($queryOpenCalls); ?></td>
                        <td><?php echo mysqli_num_rows($queryInProgress); ?></td>
                        <td><?php echo mysqli_num_rows($queryFinish); ?></td>
                        <td><?php echo mysqli_num_rows($queryCall); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row" style="margin-top: 50px; margin-bottom: 125;">
        <div class="col-12 col-md-6 overview-in-progress">
            <h3 class="title-page">EM ANDAMENTO</h3>
            <canvas id="myChart"></canvas>
        </div>
        <div class="col-12 offset-md-2 col-md-4 overview-level">
          <h3 class="title-page" style="text-align: center;">MEUS CHAMADOS POR <br> NÍVEL DE DIFICULDADE</h3>
          <canvas id="myChart4"></canvas>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
        <?php 

            $usuarios="";
            foreach($executeUsers as $user){
                
                $usuarios .= "'" . $user['username'] . "', ";
            }

            $usuarios = rtrim($usuarios, ', ');

            echo $usuarios;
        ?>
    ],
      datasets: [{
        label: 'Em andamento',
        data: [
            <?php 
                echo $countCallsAgent01.",".$countCallsAgent02.",".$countCallsAgent03.",".$countCallsAgent04;
            ?>
        ],
        backgroundColor: [
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)',
            'rgb(123, 104, 238)',
            'rgb(0, 250, 154)'
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

  const ctx2 = document.getElementById('myChart2');

  new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: [
        <?php 

            $usuarios="";
            foreach($executeUsers as $user){
                
                $usuarios .= "'" . $user['username'] . "', ";
            }

            $usuarios = rtrim($usuarios, ', ');

            echo $usuarios;
        ?>
    ],
      datasets: [{
        label: 'Chamados Finalizados',
        data: [
            <?php 
                echo $countFinishAgent01.",".$countFinishAgent02.",".$countFinishAgent03.",".$countFinishAgent04;
            ?>
        ],
        backgroundColor: [
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)',
            'rgb(123, 104, 238)',
            'rgb(0, 250, 154)'
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
            data: [ <?php echo $countEmAberto.", ".$countEmAndamento.", ".$countFinalizados ?>],
            backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 205, 86)',
            'rgb(0, 250, 154)'
            ],
            hoverOffset: 4
        }]
    }
  });

  const ctx4 = document.getElementById('myChart4');

  new Chart(ctx4, {
    type: 'doughnut',
    data: {
        labels: [
            'Sem atribuição',
            'Baixa',
            'Media',
            'Alta',
            'Critica'
        ],
        datasets: [{
            label: 'Quantidade',
            data: [ <?php echo $countCallNull.", ".$countCallLow.", ".$countCallMedium.", ".$countCallHigh.", ".$countCallCritical ?>],
            backgroundColor: [
              'rgb(0, 250, 154)',
              'rgb(54, 162, 235)',
              'rgb(255, 205, 86)',
              'rgb(255, 99, 132)',
              'rgb(123, 104, 238)'
            ],
            hoverOffset: 4
        }]
    }
  })

</script>

<?php 
    require_once '../includes/footer.php';
?>