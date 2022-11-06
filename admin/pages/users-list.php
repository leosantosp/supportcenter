<?php 

    include_once '../php_action/db_connect.php'; // Conexão com banco de dados

    session_start(); // Iniciando sessão

    if(isset($_SESSION['mensagem'])){
        echo $_SESSION['mensagem'];
    }

    // Verificando a sessão
    if(!isset($_SESSION['logado'])):
        header('Location: index.php');
    endif;

    // Captura de dados da sessão
    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";

    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);

    if($dados['profile'] == "user" || $dados['profile'] == "author"){
        header('Location: home.php');
    }

    include_once '../includes/header.php';
?>

<div class="row no-gutters mt-4">
        <div class="col-12 col-md-8 offset-md-2">
            <h3 class="text-center">Usuários</h3>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Username</th>
                        <th>Login</th>
                        <th>E-mail</th>
                        <th>Profile</th>
                        <th class="text-center" colspan="2">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                        // Realizando o select e atribuindo a uma variável
                        $sql = "SELECT * FROM usuarios";
                        
                        $resultado = mysqli_query($connect, $sql);

                        if(mysqli_num_rows($resultado) > 0):

                        // Enquanto (dados = a quantidade de resultados retornados)
                        while($dados = mysqli_fetch_array($resultado)):
                    ?>
                    <tr>
                        <td><?php echo $dados['username']; ?></td>
                        <td><?php echo $dados['login']; ?></td>
                        <td><?php echo $dados['email']; ?></td>
                        <td><?php echo $dados['profile']; ?></td>
                        <td><a href="users-edit.php?id=<?php echo $dados['id']; ?>" class="btn btn-primary">Editar</a></td>
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
                            <p>Tem certeza que deseja excluir o colaborador <strong><?php echo $dados['username'] ?></strong> </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <form action="../php_action/delete-users.php" method="POST">
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
            <a href="users-add.php" class="btn btn-success">Adicionar usuário</a>
        </div>
    </div>



<?php 
    include_once '../includes/footer.php';
?>