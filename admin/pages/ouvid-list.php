<?php 



    include_once '../php_action/db_connect.php';

    session_start();
    

    if(isset($_SESSION['mensagem'])){
        echo $_SESSION['mensagem'];
    }
    
    
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

    include_once '../includes/header.php';
?>

    <div class="row no-gutters mt-4">
        <div class="col-12 col-md-10 offset-md-1">
            <h3 class="page-title text-center">Ouvidoria Interna</h3>
            <table class="table table-admin">
                <thead class="thead-dark thead-table">
                    <tr>
                        <th class="th-title">ID</th>
                        <th class="th-title">Filial</th>
                        <th class="th-title">Departamento</th>
                        <th class="th-title">Nome</th>
                        <th class="th-title">Ramal</th>
                        <th class="th-title">E-mail</th>
                        <th class="th-title">Setor</th>
                        <th class="th-title">Notificação</th>
                        <th class="th-title">Relato</th>
                        <th class="th-title text-center">Ações</th>
                    </tr>
                </thead>

                <tbody class="tbody-table">
                    <?php 
                        // Realizando o select e atribuindo a uma variável
                        $sql = "SELECT * FROM ombudsman";
                        
                        $resultado = mysqli_query($connect, $sql);

                        if(mysqli_num_rows($resultado) > 0):

                        // Enquanto (dados = a quantidade de resultados retornados)
                        while($dados = mysqli_fetch_array($resultado)):
                    ?>
                    <tr>
                        <td>#<?php echo $dados['id']; ?></td>
                        <td><?php echo $dados['company']; ?></td>
                        <td><?php echo $dados['department']; ?></td>
                        <td><?php echo $dados['name']; ?></td>
                        <td><?php echo $dados['phone']; ?></td>
                        <td><?php echo $dados['email']; ?></td>
                        <td><?php echo $dados['sector'] ?></td>
                        <td><?php echo $dados['notification'] ?></td>
                        <td><?php echo $dados['report'] ?></td>
                        <td><a data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $dados['id']; ?>" class="btn btn-danger">Excluir</a></td>
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
                            <p>Tem certeza que deseja excluir o relato #<strong><?php echo $dados['id'] ?></strong> </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <form action="../php_action/delete-ouvid.php" method="POST">
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

        </div>
    </div>


<?php 

    include_once '../includes/footer.php';
?>
