<?php

    session_start();

    include_once 'db_connect.php';

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    if(!empty($id)){
        $sql = "DELETE FROM reservations WHERE id=:id";
        $delete_event = $connect->prepare($sql);

        $delete_event->bindParam("id", $id);

        if($delete_event->execute()){
            $_SESSION['mensagem'] = '<div class="alert alert-success" role="alert">ERRO: O evento foi apagado com sucesso!</div>';
            header('Location: index.php');
        } else {
            $_SESSION['mensagem'] = '<div class="alert alert-danger" role="alert">ERRO: O evento não foi apagado!</div>';
            header("Location: index.php");
        }

    } else {
        $_SESSION['mensagem'] = "<div class='alert alert-sucess' role='alert'>ERRO: evento não foi apagado!</div>";
        header("Location: index.php");
    }