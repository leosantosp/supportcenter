<?php 

    /**
     * Realizando o require_once com o arquivo para acesso ao banco de dados
     */
    require_once 'php_action/db_connect.php';

    /**
     * Iniciando a sessão
     */
    session_start();

    /**
     * Verificação
     */

    if(!isset($_SESSION['logado'])):
        header('Location: index.php');    
    endif;

    /**
     * Captura de dados da sessão
     */

    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";

    $resultado = mysqli_query($connect, $sql);

    $dados = mysqli_fetch_array($resultado);
    /**
     * Fez uma consulta, apresentou os dados, feche a conexão
     */ 
    mysqli_close($connect);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin | Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body id="admin-panel">

    <h1>Bem vindo, <?php echo $dados['username']; ?>!</h1>

    <nav class="admin-nav">
        <ul class="admin-nav-list">
            <li class="admin-nav-item"><a href="pages/users-list.php">Usuários</a></li>
            <li class="admin-nav-item"><a href="pages/colab-list.php">Colaboradores</a></li>
            <li class="admin-nav-item"><a href="pages/catend-list.php">Catálogo de Endereços</a></li>
            <li class="admin-nav-item"><a href="#">Reserva de Salas</a></li>
            <li class="admin-nav-item"><a href="#">Unidades</a></li>
            <li class="admin-nav-item"><a href="#">Tutoriais</a></li>
            <li class="admin-nav-item"><a href="#">Erros do Sintra</a></li>
            <li class="admin-nav-item"><a href="#">Ouvidoria</a></li>
            <li class="admin-nav-item">
                <a href="logout.php">
                    <button class="btn btn-secondary">LOGOUT</button>
                </a>
            </li>
        </ul>
    </nav>

    

<script src="assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>