<?php 
    /**
     * @var string
     * Encerrando a sessão
     */

     session_start(); // Iniciar a sessão
     session_unset(); // Desativa a sessão
     session_destroy(); // Destrói a sessão

     header('Location: index.php');