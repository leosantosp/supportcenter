<?php   

session_start();

include_once './conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if(!empty($id)) {
   $query_event = "DELETE FROM events WHERE id=:id";
   $delete_event = $conn -> prepare($query_event);

   $delete_event->bindParam("id", $id);

   if($delete_event->execute()){
        $_SESSION['msg'] = '<div class="alert alert-success" role="alert">ERRO: O evento foi apagado com sucesso!</div>';
        header("Location: admin.php");
   } else {
        $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">ERRO: O evento não foi apagado!</div>';
        header("Location: admin.php");

   }

} else {
        $_SESSION['msg'] = "<div class='alert alert-sucess' role='alert'>ERRO: evento não foi apagado!</div>";
        header("Location: admin.php");
}