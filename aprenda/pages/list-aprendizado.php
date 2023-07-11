<?php 

    // Iniciando conexão com database
    include_once '../php_action/db_connect.php';

    session_start();

    

    if(!isset($_SESSION['logado'])):
        header('Location: index.php');
    endif;

    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";

    $resultado = mysqli_query($connect, $sql);
    $infosessao = mysqli_fetch_array($resultado);


?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Aprenda</title>
    <link rel="stylesheet" href="../assets/css/style.css">
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
            <img class="image" src="../../assets/images/logo.svg" alt="">
            <h4><?php echo $infosessao['username'] ?></h4>
        </div>
        <a href="#"><ion-icon name="desktop-outline"></ion-icon><span>Home</span></a> <!-- Home -->
        <a href="../../reservation-room/index.php"><ion-icon name="mail-unread-outline"></ion-icon> <span>Reserva de Salas</span>    </a> <!-- Sala de Reunião -->
        <a href="../logout.php"><ion-icon name="log-out-outline"></ion-icon> <span>Sair</span>    </a> <!-- Sair -->
    </div>

    <div class="content">

    <?php 
        if(isset($_SESSION['mensagem'])){
            echo $_SESSION['mensagem'];
        }
    ?>

<div class="row no-gutters mt-4">
        <div class="col-12 col-md-10 offset-md-1">
            <h3 class="page-title text-center"><ion-icon name="mail-outline"></ion-icon> Aprendizados</h3>
            <table id="table" class="table table-admin">
                <thead class="thead-table thead-dark">
                    <tr>
                        <th class="th-title">Titulo</th>
                        <th class="th-title">Description</th>
                        <th class="th-title">Classificação</th>
                        <th class="th-title">Arquivos</th>
                        <th class="th-title text-center" colspan="2">Ações</th>
                    </tr>
                    <tr>
                        <th class="th-search"><input class="form-control" id="srcTitle" type="text"></th>
                        <th class="th-search"><input class="form-control" id="srcDescription" type="text"></th>
                        <th class="th-search"><input class="form-control" id="srcClass" type="text"></th>
                        <th class="th-search"></th>
                        <th class="th-search"></th>
                        <th class="th-search"></th>
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
                            if($dados['class'] === "geral" OR $dados['class'] === $infosessao['profile']):
                    ?>
                    <tr>
                        
                        <td><?php echo $dados['title']; ?></td>
                        <td><?php echo $dados['description']; ?></td>
                        <td><?php echo $dados['class']; ?></td>
                        <td>
                        <?php 
                        
                            $arquivosNomes = explode(';', $dados['file']);
                            
                            foreach($arquivosNomes as $valor){
                                $link = "../aprenda/aprenda/".$dados['class']."/".$valor;

                                 echo "<a href=".$link." download>$valor</a><br>";
                            }

                        ?>
                        </td>
                        <td><a href="edit-aprendizado.php?id=<?php echo $dados['id']; ?>" class="btn btn-primary"><ion-icon name="create-outline"></ion-icon></a></td>
                        <td><a data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $dados['id']; ?>" class="btn btn-danger"><ion-icon name="trash-outline"></ion-icon></a></td>
                        
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="deleteModal<?php echo $dados['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $dados['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel<?php echo $dados['id']; ?>">OPA!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Tem certeza que deseja excluir o aprendizado <strong><?php echo $dados['title'] ?></strong>? </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <form action="../php_action/delete-aprendizado.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $dados['id'] ?>">
                                <input type="hidden" name="permission" value="<?php echo $infosessao['permission'] ?>">
                                <button type="submit" name="btn-delete" class="btn btn-danger">Sim, quero excluir</button>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>

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
            <a href="add-aprendizado.php" class="btn btn-success"><ion-icon name="add-outline"></ion-icon> Novo aprendizado</a>
        </div>
    </div>


<?php 

    include_once '../includes/footer.php';
?>