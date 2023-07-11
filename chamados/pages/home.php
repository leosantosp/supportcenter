<?php 
    $titlepage = "Home | Helpdesk VIPEX";
    require_once '../includes/header.php';
?>

    <?php 
        $statusDefault = "Em triagem";
        $statusFinish = "Finalizado";
        
        $sqlCall = "SELECT * FROM chamados WHERE username_id = ".$dados['id']."";
        $queryCall = mysqli_query($connect, $sqlCall);
        
        $sqlOpenCalls = "SELECT * FROM chamados WHERE username_id = ".$dados['id']." AND responsavel is NULL";
        $queryOpenCalls = mysqli_query($connect, $sqlOpenCalls);

        $callsInProgress = "SELECT * FROM chamados WHERE username_id = ".$dados['id']." AND status <> '$statusDefault' AND status <> '$statusFinish'";
        $queryInProgress = mysqli_query($connect, $callsInProgress);

        $callFinish = "SELECT * FROM chamados WHERE username_id = ".$dados['id']." AND status = '$statusFinish'";
        $queryFinish = mysqli_query($connect, $callFinish);
        
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
            <th>Em Aberto</th>
            <th>Em Andamento</th>
            <th>Finalizado</th>
            <th>Total</th>
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
    <a href="abrir-chamado.php" class="btn btn-success">Novo chamado</a>

    <ul class="call-legendas">
        <li><strong>LEGENDA:</strong></li>
        <li><strong>Em aberto:</strong> Chamados que você abriu mas que nenhum agente pegou ainda</li>
        <li><strong>Em andamento: </strong>Chamados que estão sendo atendidos pela equipe</li>
        <li><strong>Finalizado: </strong>Chamados que você abriu e já foram finalizados</li>
        <li><strong>Total: </strong>Quantidade total de chamados que você abriu</li>
    </ul>
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