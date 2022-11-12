<?php

    include 'db_connect.php';

    $sql = "SELECT * FROM reservations";
    $resultado = mysqli_query($connect, $sql);


    // $dados = mysqli_fetch_array($resultado);

    // var_dump($dados);
    // exit;

    $reservations = [];

    while($reservations_list = mysqli_fetch_array($resultado)){
        

        $id = $reservations_list['id'];
        $title = $reservations_list['title'];
        $host = $reservations_list['host'];
        $hostid = $reservations_list['hostid'];
        $email = $reservations_list['email'];
        $guests = $reservations_list['guests'];
        $room = $reservations_list['room'];
        $start = $reservations_list['start'];
        $end = $reservations_list['end'];
        $color;

        if($room === "Carreta"){
            $color = "blue";
        } elseif($room === "VUC"){
            $color = "purple";
        } else {
            $color = "cyan";
        }

        $reservations[] = [
            'id' => $id,
            'title' => $title,
            'host' => $host,
            'hostid' => $hostid,
            'guests' => $guests,
            'email' => $email,
            'room' => $room,
            'start' => $start,
            'end' => $end,
            'color' => $color
        ];
    }

    echo json_encode($reservations);