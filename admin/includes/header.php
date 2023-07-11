
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Painel Administrativo</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>

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
            <img class="image" src="../../assets/images/logo.svg" alt="">
            <h4><?php echo $dados['username'] ?></h4>
        </div>
        <?php 
            if($dados['profile'] == 'ti'){
                echo "<a href='../../chamados/admin.php'><ion-icon name='bar-chart-outline'></ion-icon><span>Dashboard</span></a>";
                echo "<a data-bs-toggle='collapse' href='#cadastro' role='button' aria-expanded='false' aria-controls='cadastro'><ion-icon name='bookmark-outline'></ion-icon> <span>Cadastros</span></a>
                        <div class='collapse' id='cadastro'>
                            <a href='company-list.php'> &nbsp;&nbsp;&nbsp;&nbsp; > Empresas</a>   
                            <a href='errors-list.php'> &nbsp;&nbsp;&nbsp;&nbsp; > Erros do SINTRA</a>   
                            <a href='catend-list.php'> &nbsp;&nbsp;&nbsp;&nbsp; > Base do Outlook</a>   
                            <a href='users-list.php'> &nbsp;&nbsp;&nbsp;&nbsp; > Usuários</a>   
                        </div>";
                
                echo "<a data-bs-toggle='collapse' href='#chamados' role='button' aria-expanded='false' aria-controls='chamados'><ion-icon name='bug-outline'></ion-icon><span> Chamados</span></a>
                <div class='collapse' id='chamados'>
                    <a href='../../chamados/pages/open-chamados.php'>&nbsp;&nbsp;&nbsp;&nbsp;<span> > Chamados em Aberto</span></a>
                    <a href='../../chamados/pages/meus-chamados.php'> &nbsp;&nbsp;&nbsp;&nbsp; > Meus chamados</span></a>   
                    <a href='../../chamados/pages/chamados-finalizados.php'>&nbsp;&nbsp;&nbsp;&nbsp;<span> > Chamados finalizados</span></a>   
                    <a href='../../chamados/pages/abrir-chamado.php'>&nbsp;&nbsp;&nbsp;&nbsp; <span> > Novo chamado</span></a>
                    <a href='../../chamados/pages/sil-chamados.php'>&nbsp;&nbsp;&nbsp;&nbsp; > Chamados SIL</a>
                </div>";

            }
            else if ($dados['profile'] == 'dir'){
                echo "<a href='../../chamados/pages/visao-geral-ti.php'><ion-icon name='eye-outline'></ion-icon><span>Overview do T.I</span></a>";
                echo "<a href='../../chamados/pages/home.php'><ion-icon name='eye-outline'></ion-icon><span>Minha Overview</span></a>";
                echo "<a href='../../chamados/pages/abrir-chamado.php'><ion-icon name='add-outline'></ion-icon><span>Novo chamado</span></a>";
                echo "<a href='../../chamados/pages/list-chamados.php'><ion-icon name='bug-outline'></ion-icon><span>Meus chamados</span></a>";
                echo "<a href='../../chamados/pages/chamados-finalizados-colab.php'><ion-icon name='bug-outline'></ion-icon><span>Chamados finalizados</span></a>";
                echo "<a href='../../chamados/pages/sil-chamados.php'><ion-icon name='bug-outline'></ion-icon> <span>Chamados SIL</span></a>";

            }
            else{
                echo "<a href='../../chamados/home.php'><ion-icon name='eye-outline'></ion-icon><span>Visão Geral</span></a>";
                echo "<a href='../../chamados/pages/abrir-chamado.php'><ion-icon name='add-outline'></ion-icon><span>Novo chamado</span></a>";
                echo "<a href='../../chamados/pages/list-chamados.php'><ion-icon name='bug-outline'></ion-icon><span>Meus chamados</span></a>";
                echo "<a href='../../chamados/pages/chamados-finalizados-colab.php'><ion-icon name='bug-outline'></ion-icon><span>Chamados finalizados</span></a>";
            }
        ?>

        <a href="../../reservation-room/home.php"><ion-icon name="calendar-clear-outline"></ion-icon> <span>Reserva de Salas</span></a>
        <a href="../../chamados/pages/alterar-dados.php"><ion-icon name='settings-outline'></ion-icon><span>Editar perfil</span></a>
        
        <a href="logout.php"><ion-icon name="log-out-outline"></ion-icon> <span>Sair</span></a> <!-- Sair -->



    </div>

    <div class="content">

<?php 
    if(isset($_SESSION['mensagem'])){
        echo $_SESSION['mensagem'];
        unset($_SESSION['mensagem']);
    }
?>