<?php

include 'conexao.php';

$query_events = "SELECT id, title, nome, contato, room, start, end FROM events";
$resultado_events = $conn->prepare($query_events);
$resultado_events->execute();

$eventos = [];

while($row_events = $resultado_events->fetch(PDO::FETCH_ASSOC)){
    $id = $row_events['id'];
    $title = $row_events['title'];
    $nome = $row_events['nome'];
    $contato = $row_events['contato'];
    $room = $row_events['room'];
    $start = $row_events['start'];
    $end = $row_events['end'];
    $eventos[] = [
            'id' => $id, 
            'title' => $title,
            'nome' => $nome,
            'contato' => $contato,
            'room' => $room,
            'start' => $start,
            'end' => $end,
            'color' => $room === 'Sala 01 - Principal' ? 'blue' : 'purple'
    ];

}

echo json_encode($eventos);
