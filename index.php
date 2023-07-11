<?php 
    session_start();
    if(isset($_SESSION['mensagem'])){
        echo $_SESSION['mensagem'];
    }
    session_unset();


    include_once 'admin/php_action/db_connect.php';

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Central de Suporte | Sua Intranet Corporativa</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
    <script src="assets/js/svg-inject.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Mukta:wght@300;400&display=swap" rel="stylesheet">
</head>
<body class="body-index">

    <div class="bg-loader">
        <svg class="svg-index" style="max-width: 144px;" width="96" height="96" viewBox="0 0 619 628" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path class="logo-supportcenter" d="M1 310.5L302 6V137.5L129.5 310.5L309 494L482.5 310.5L309 137.5V1H617L531.5 103.5H405L617 310.5L302 626.5L1 310.5Z" fill="#EEF3FA" stroke="white"/>
        </svg>
    </div>
    
    <header class="index-header">
        <nav class="navbar">
            <div class="nav-menu">
                <div class="logo">
                    <a href="#"><img class="img-index" src="assets/images/logo.svg" onload="SVGInject(this)" alt=""></a>
                </div>
                <ul class="nav-list">
                    <li><a href="colaborators.php" class="nav-link">Colaboradores</a></li>
                    <li><a href="system-errors.php" class="nav-link">Erros</a></li>
                    <li><a href="aprenda/index.php" class="nav-link">Aprenda</a></li>
                    <li><a href="companys.php" class="nav-link">Empresas</a></li>
                    <li><a href="ouvidoria.php" class="nav-link">Ouvidoria</a></li>
                    <li><a href="reservation-room/index.php" class="nav-link">Reserva de Sala</a></li>
                    <li><a href="https://sintraweb.sdso.com.br/sintraweb/hsin000.aspx" class="nav-link">SINTRA</a></li>
                    <li><a href="chamados/index.php" class="nav-link">Chamados T.I</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- BACKGROUND VIDEO -->
    <section class="bg-video">
        <video class="vipex-video" autoplay muted loop>
            <source src="assets/video/bg-video-vipex.mp4" type="video/mp4">
        </video>
    </section>

    <!-- CONTAINER -->
    <section class="highlight container">
        
        <div class="highlight-text">
            <h1 class="highlight-title item-1">CENTRAL DE SUPORTE</h1>
            <p class="highlight-desc item-2">Sua Intranet para Colaboradores. <br><br>
                Na Central de Suporte você pode consultar várias informações referente a empresa e ficar por dentro de tudo que acontece nela.
                Notícias, Listas de Ramais, Tutoriais, Erros de Sistema, Ouvidoria, tudo por aqui. <br><br>

                Um desenvolvimento de: Leonardo Santos [T.I]
            </p>
        </div>

    </section>


    <script src="assets/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js" integrity="sha512-DkPsH9LzNzZaZjCszwKrooKwgjArJDiEjA5tTgr3YX4E6TYv93ICS8T41yFHJnnSmGpnf0Mvb5NhScYbwvhn2w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js"></script>

</body>
</html>

    

<?php 

    
?>
