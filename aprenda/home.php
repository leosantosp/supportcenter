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

    $infosessao = mysqli_fetch_array($resultado);
    /**
     * Fez uma consulta, apresentou os dados, feche a conexão
     */ 

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Aprenda</title>
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
            <h4><?php echo $infosessao['username'] ?></h4>
        </div>
        <a href="#"><ion-icon name="desktop-outline"></ion-icon><span>Home</span></a> <!-- Home -->
        <?php 
            if($infosessao['permission'] == 1){
        ?>
            <a href="pages/add-aprendizado.php"><ion-icon name="file-tray-full-outline"></ion-icon><span> Novo aprendizado</span></a>
            <a href="pages/list-aprendizado.php"><ion-icon name="file-tray-full-outline"></ion-icon><span>Editar aprendizados</span></a>
        <?php
                }
        ?>
        
        <a href="logout.php"><ion-icon name="log-out-outline"></ion-icon> <span>Sair</span>    </a> <!-- Sair -->


    </div>

    <div class="content">
        <h3>Bem vindo, <strong> <?php echo $infosessao['username']; ?></strong></h3>
        <p>Este é o APRENDA da Central de Suporte</p>
        <p>Este é o local onde o seu setor pode utilizar para armazenar procedimentos. Um local seguro e visto apenas pelo seu setor.</p>
        <div class="row no-gutters mt-4">
        <div class="col-12 col-md-10 offset-md-1">
            <h3 class="page-title text-center"><ion-icon name="mail-outline"></ion-icon> Aprendizados</h3>
            <table id="table" class="table table-admin">
                <thead class="thead-table thead-dark">
                    <tr>
                        
                        <th class="th-title text-center">Titulo</th>
                        <th class="th-title text-center">Description</th>
                        <th class="th-title text-center">Classificação</th>
                        <th class="th-title text-center">Arquivos</th>
                    </tr>
                    <tr>
                        
                        <th class="th-search"><input class="form-control" id="srcCompany" type="text"></th>
                        <th class="th-search"><input class="form-control" id="srcDepartment" type="text"></th>
                        <th class="th-search"><input class="form-control" id="srcNome" type="text"></th>
                        <th class="th-search" colspan="3"><input class="form-control" id="srcEmail" type="text"></th>
                    </tr>
                </thead>

                <tbody class="tbody-table">
                    <?php 
                        // Montando a Query
                        $sql = "SELECT * FROM tutoriais";
                        
                        // Executando a Query
                        $resultado = mysqli_query($connect, $sql);

                        // Se o resultado da execução for mais que zero, execute 
                        if(mysqli_num_rows($resultado) > 0):

                        // Enquanto (dados = a quantidade de resultados retornados)
                        while($dados = mysqli_fetch_array($resultado)):
                            if($dados['class'] === "geral" OR $dados['class'] === $infosessao['profile'] OR $infosessao['profile'] === 'ti'):
                    ?>
                    <tr>
                        
                        
                        <td><?php echo $dados['title']; ?></td>
                        <td><?php echo $dados['description']; ?></td>
                        <td class="text-center class"><?php echo $dados['class']; ?></td>
                        
                        <?php 
                        
                            $arquivosNomes = explode(';', $dados['file']);

                            foreach($arquivosNomes as $valor){
                                $link = "../aprenda/aprenda/".$dados['class']."/".$valor;

                                echo "<td> <a href=".$link." download>$valor</a></td>";
                            }

                        ?>
                        
                    </tr>

                    

                    <?php 
                            endif;
                        endwhile; 
                    else : ?>
                    
                        <tr>
                            <td colspan="8" class="text-center">Não existem dados para serem exibidos!</td>
                        </tr>

                    <?php
                        endif;
                    ?>
                </tbody>
            </table>

            <br>
            
            <?php if($infosessao['permission'] == 1){ ?>
                <a href="pages/add-aprendizado.php" class="btn btn-success"><ion-icon name="add-outline"></ion-icon> Novo aprendizado</a>
            <?php }; ?>
        </div>
    </div>
    </div>




    

    

<script src="assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>