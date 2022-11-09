<?php

    include_once 'db_connect.php';

    $sql = "SELECT id, title, host, email, guests, room, start, end FROM reservations";
    $resultado = $connect->prepare($sql);
    $resultado->execute();

    $reservations = [];

    while($row_events = $resultado->fetch(PDO::FETCH_ASSOC)){
        $id = $row_events['id'];
        $title = $row_events['title'];
        $host = $row_events['host'];
        $email = $row_events['email'];
        $guests = $row_events['guests'];
        $room = $row_events['room'];
        $start = $row_events['start'];
        $end = $row_events['end'];

        if($room === "VUC"){
            echo 'blue';
        } else if($room === "Carreta"){
            echo 'purple';
        } else {
            echo 'gray';
        }


        $reservations[] = [
            'id' => $id,
            'title' => $title,
            'host' => $host,
            'email' => $email,
            'guests' => $guests,
            'room' => $room,
            'start' => $start,
            'end' => $end,
            'color' => $room
        ];
    }

    echo json_encode($reservations);