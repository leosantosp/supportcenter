<?php 
date_default_timezone_set('America/Sao_Paulo');

session_start();

include_once 'conexao.php';


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$data_start = str_replace('/', '-', $dados['start']);
$data_start_conv = date("Y-m-d H:i:s", strtotime($data_start));
$data_start_datetime = new DateTime($data_start_conv);

$data_end = str_replace('/', '-', $dados['end']);
$data_end_conv = date("Y-m-d H:i:s", strtotime($data_end));
$data_end_datetime = new DateTime($data_end_conv);

$q =  "SELECT * FROM events WHERE events.room = :room AND :start_date < end  AND :end_date > start";

$stmt = $conn->prepare($q);
$stmt->bindParam(':room', $dados['room']);
$stmt->bindParam(':start_date', $data_start_conv);
$stmt->bindParam(':end_date', $data_end_conv);
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_CLASS);

if(!empty($result)){
    $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">ERRO: RESERVA NÃO REALIZADA! DATA E HORA NÃO DISPONÍVEL</div>'];
    
    header('Content-Type: application/json');
    echo json_encode($retorna);

    exit;
} 



$query_event = "INSERT INTO events (title, nome, contato room, start, end) VALUES (:title, :nome, :contato, :room, :start, :end)";

$insert_event = $conn->prepare($query_event);
$insert_event->bindParam(':title', $dados['title']);
$insert_event->bindParam(':room', $dados['room']);
$insert_event->bindParam(':nome', $dados['nome']);
$insert_event->bindParam(':contato', $dados['contato']);
$insert_event->bindParam(':start', $data_start_conv);
$insert_event->bindParam(':end', $data_end_conv);


if ($insert_event->execute()) {
    $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">SUCESSO: RESERVA REALIZADA COM SUCESSO!</div>'];
    $_SESSION['msg'] = '<div class="alert alert-success" role="alert">SUCESSO: RESERVA REALIZADA COM SUCESSO!</div>';
} else {
    $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">ERRO: RESERVA NÃO REALIZADA! VERIFIQUE OS CAMPOS E PREENCHA NOVAMENTE</div>'];
}



header('Content-Type: application/json');
echo json_encode($retorna);