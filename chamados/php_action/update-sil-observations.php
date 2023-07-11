<?php 
    date_default_timezone_set('America/Sao_Paulo');
    $date = date('Y-m-d H:i');

    session_start();

    require_once 'db_connect.php';

    if(isset($_POST['btn-observations'])){
        $callid = mysqli_escape_string($connect, $_POST['callid']);
        $chamadoid = mysqli_escape_string($connect, $_POST['chamadoid']);
        $responsavel = mysqli_escape_string($connect, $_POST['responsavel']);
        $observations = mysqli_escape_string($connect, $_POST['observations']);

        if(empty($chamadoid)){
            $chamadoid = 0;
        }

        if(empty($observations)){
            $updateObs = "UPDATE chamados_sil SET responsavel='$responsavel', data_observacoes='$date', chamado_id='$chamadoid' WHERE id = '$callid'";
        } else {
            $updateObs = "UPDATE chamados_sil SET responsavel='$responsavel', observacoes='$observations', data_observacoes='$date', chamado_id='$chamadoid' WHERE id = '$callid'";
        }

        

        if(mysqli_query($connect, $updateObs)){
            $_SESSION['mensagem'] = "<div class='alert alert-success'>Observações inseridas com sucesso</div>";
            header('Location: ../pages/sil-chamados.php');
        } else {
            $_SESSION['mensagem'] = "<div class='alert alert-danger'>Ação não executada</div>";
            header('Location: ../pages/sil-chamados.php');
        }
    }