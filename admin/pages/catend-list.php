<?php 

    // Iniciando conexão com database
    include_once '../php_action/db_connect.php';

    session_start(); // Iniciando sessão

    // Mensagem de Retorno
    if(isset($_SESSION['mensagem'])){
        echo $_SESSION['mensagem'];
    }
    

    // Verificando se o usuário está logado
    if(!isset($_SESSION['logado'])):
        header('Location: index.php');
    endif;

    // Captura dos dados da sessão 'logado'
    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";

    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);

    include_once '../includes/header.php';

?>

<div class="row no-gutters mt-4">
        <div class="col-12 col-md-10 offset-md-1">
            <h3 class="page-title text-center"><ion-icon name="mail-outline"></ion-icon> Endereços de E-mail</h3>
            <table id="table" class="table table-admin">
                <thead class="thead-table thead-dark">
                    <tr>
                        <th class="th-title">Tratamento</th>
                        <th class="th-title">Empresa</th>
                        <th class="th-title">Cargo</th>
                        <th class="th-title">E-mail</th>
                        <th class="th-title">Senha</th>
                        <th class="th-title text-center" colspan="2">Ações</th>
                    </tr>
                    <tr>
                        <th class="th-search"><input class="form-control" id="srcCompany" type="text"></th>
                        <th class="th-search"><input class="form-control" id="srcDepartment" type="text"></th>
                        <th class="th-search"><input class="form-control" id="srcNome" type="text"></th>
                        <th class="th-search"><input class="form-control" id="srcEmail" type="text"></th>
                        <th class="th-search" colspan="3"></th>
                    </tr>
                </thead>

                <tbody class="tbody-table">
                    <?php 
                        // Montando a Query
                        $sql = "SELECT * FROM catalogoenderecos";
                        
                        // Executando a Query
                        $resultado = mysqli_query($connect, $sql);

                        // Se o resultado da execução for mais que zero, execute 
                        if(mysqli_num_rows($resultado) > 0):

                        // Enquanto (dados = a quantidade de resultados retornados)
                        while($dados = mysqli_fetch_array($resultado)):
                    ?>
                    <tr>
                        <td><?php echo $dados['tratamento']; ?></td>
                        <td><?php echo $dados['empresa']; ?></td>
                        <td><?php echo $dados['cargo']; ?></td>
                        <td><?php echo $dados['email']; ?></td>
                        <td><?php echo $dados['senha']; ?></td>
                        <td><a href="catend-edit.php?id=<?php echo $dados['id']; ?>" class="btn btn-primary"><ion-icon name="create-outline"></ion-icon></a></td>
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
                            <p>Tem certeza que deseja excluir o e-mail <strong><?php echo $dados['tratamento'] ?></strong>? </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <form action="../php_action/delete-catend.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $dados['id'] ?>">
                                <button type="submit" name="btn-delete" class="btn btn-danger">Sim, quero excluir</button>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>

                    <?php 
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
            <a href="catend-add.php" class="btn btn-success"><ion-icon name="add-outline"></ion-icon> Adicionar e-mail</a>
            <a class="btn-excel" href="../../includes/colab-excel.php"><ion-icon name="file-tray-stacked-outline"></ion-icon> Gerar Excel</a>
        </div>
    </div>


<?php 

    include_once '../includes/footer.php';
?>
