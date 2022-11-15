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
    <title>Home | Painel Administrativo</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body id="home-admin-panel">
    <input type="checkbox" id="check">
    <header>
        <div class="icon-menu">
            <label for="check">
                <ion-icon name="grid-outline" id="sidebar-btn"></ion-icon>
            </label>
        </div>
    </header>
    <div class="sidebar">
        <div class="center">
            <img class="image" src="../assets/images/logo.svg" alt="">
            <h4><?php echo $dados['username'] ?></h4>
        </div>
        <a href="#"><ion-icon name="desktop-outline"></ion-icon><span>Home</span></a> <!-- Home -->
        <a href="pages/users-list.php"><ion-icon name="person-outline"></ion-icon> <span>Usuários</span>    </a> <!-- Usuários -->
        <a href="pages/colab-list.php"><ion-icon name="people-outline"></ion-icon> <span>Colaboradores</span>    </a> <!-- Colaboradores -->
        <a href="pages/catend-list.php"><ion-icon name="mail-unread-outline"></ion-icon> <span>Base do Outlook</span>    </a> <!-- Catálogo de Endereços -->
        <a href="../reservation-room/index.php"><ion-icon name="mail-unread-outline"></ion-icon> <span>Reserva de Salas</span>    </a> <!-- Sala de Reunião -->
        <a href="pages/company-list.php"><ion-icon name="git-branch-outline"></ion-icon> <span>Empresas</span>    </a> <!-- Empresas -->
        <a href="pages/tutorials-list.php"><ion-icon name="book-outline"></ion-icon> <span>Aprenda</span>    </a> <!-- Aprenda -->
        <a href="pages/errors-list.php"><ion-icon name="bug-outline"></ion-icon> <span>Erros</span>    </a> <!-- Erros -->
        <a href="pages/ouvid-list.php"><ion-icon name="archive-outline"></ion-icon><span>Ouvidoria</span>    </a> <!-- Ouvidoria -->
        <a href="logout.php"><ion-icon name="log-out-outline"></ion-icon> <span>Sair</span>    </a> <!-- Sair -->


    </div>

    <div class="content">
        <h3>Bem vindo, <strong> <?php echo $dados['username']; ?></strong></h3>
        <p>Este é o painel administrativo da Central de Suporte</p>
        <p>Utilize o painel na lateral esquerda para verificar as opções que você tem liberado.</p> 
        <p>Utilize com bastante cautela. as configurações aplicadas aqui terão influência na página principal da Central</p>

        <?php 
            if(isset($_SESSION['mensagem'])){
                echo $_SESSION['mensagem'];
                unset($_SESSION['mensagem']);
            }

        ?>
    </div>




    

    

<script src="assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>