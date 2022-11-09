<?php

    date_default_timezone_set('America/Sao_Paulo');

    session_start();

    include_once 'db_connect.php';

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $date_start = str_replace('/', '-', $dados['datestart']);
    $date_start_conv = date("Y-m-d", strtotime($date_start));
    $hour_start = $dados['hourstart'];
    $complete_start_date = "$date_start_conv"." "."$hour_start";
    $start_datetime = new DateTime($complete_start_date);

    $date_end = str_replace('/', '-', $dados['dateend']);
    $date_end_conv = date("Y-m-d", strtotime($date_end));
    $hour_end = $dados['hourend'];
    $complete_end_date = "$date_end_conv"." "."$hour_end ";
    $end_datetime = new DateTime($complete_end_date);

    $select = "SELECT * FROM reservations WHERE room = :room AND :start_date < end AND :end_date > start";

    $stmt = $connect->prepare($select);
    $stmt->bindParam(':room', $dados['room']);
    $stmt->bindParam(':start_date', $complete_start_date);
    $stmt->bindParam(':end_date', $complete_end_date);

    $resultado = $stmt->fetchAll(PDO::FETCH_CLASS);

    if(!empty($resultado)){
        $mensagem = ['sit' => false, 'mensagem' => '<div class="alert alert_danger" role="alert">ERRO: RESERVA NÃO REALIZADA! DATA E HORA NÃO DISPONÍVEL</div>'];

        header('Content-Type: application/json');
        echo json_encode($mensagem);

        exit;
    }

    $sql = "INSERT INTO reservations (title, host, email, guests, room, start, end) VALUES (:title, :host, :email, :guests, :room, :start, :end)";

    $insert_event = $connect->prepare($sql);
    $insert_event->bindParam(':title', $dados['title']);
    $insert_event->bindParam(':host', $dados['host']);
    $insert_event->bindParam(':email', $dados['email']);
    $insert_event->bindParam(':guests', $dados['guests']);
    $insert_event->bindParam(':room', $dados['room']);
    $insert_event->bindParam(':start', $complete_start_date);
    $insert_event->bindParam(':end', $complete_end_date);

    if($insert_event->execute()){
        $mensagem = ['sit' => true, 'mensagem' => '<div class="alert alert-success" role="alert">SUCESSO: RESERVA REALIZADA COM SUCESSO!</div>'];
        $_SESSION['mensagem'] = '<div class="alert alert-success" role="alert">SUCESSO: RESERVA REALIZADA COM SUCESSO!</div>';
    } else {
        $mensagem = ['sit' => false, 'mensagem' => '<div class="alert alert-danger" role="alert">ERRO: RESERVA NÃO REALIZADA! VERIFIQUE OS CAMPOS E PREENCHA NOVAMENTE</div>'];
    }

    header('Content-Type: application/json');
    echo json_encode($mensagem);