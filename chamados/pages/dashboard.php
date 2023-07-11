<?php 
    include_once '../includes/header.php';
?>

<?php 
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

    <div class="row" style="margin-top: 75px">
        <div class="col-12 offset-md-3 col-md-6 overview-in-progress">
            <h3 class="title-page">EM ANDAMENTO</h3>
            <canvas id="myChart"></canvas>
        </div>
    </div>

    <div>
        
    </div>

    <div>
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
        label: 'Chamados em Andamento',
        data: [
            <?php 
                echo $countCallsAgent01.",".$countCallsAgent02.",".$countCallsAgent03.",".$countCallsAgent04;
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
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    }
  });


</script>
<?php 
    include_once '../includes/footer.php';
?>