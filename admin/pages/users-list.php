<?php 

    include_once '../php_action/db_connect.php'; // Conexão com banco de dados

    session_start(); // Iniciando sessão

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
        <div class="users-section col-12 col-md-10 offset-md-1">
            <h3 class="users-title text-center"><ion-icon name="person-outline"></ion-icon> Usuários</h3>
            <p class="users-description">Abaixo temos uma lista de todos os usuários que podem acessar alguma sessão no sistema.
                O nível de 'profile' que o usuário tem que dirá ao que ele possui acesso ou não. 
            </p>
            <p class="users-description">Segue uma listagem sobre os tipos de profile</p>
            <ul class="users-list">
                <li><strong>ADMIN</strong>: Possui acesso total ao sistema e suas configurações, consegue criar outros usuários em qualquer nível de profile</li>
                <li><strong>USER</strong>: Possui acesso apenas a área de Aprenda e a Sala de Reuniões</li>
                <li><strong>AUTHOR</strong>: Além das mesmas opções do 'user' este usuário consegue inserir novos tutoriais e erros do sistema</li>
                <li><strong>OVERWATCH</strong>: Usuários que possuem acesso apenas a sessão de Ouvidoria</li>
            </ul>
            <table id="table" class="users-table table">
                <thead class="users-thead thead-dark">
                    <tr>
                        <th class="th-title">Nome de Usuário</th>
                        <th class="th-title">Login</th>
                        <th class="th-title">E-mail</th>
                        <th class="th-title">Profile</th>
                        <th class="th-title text-center" colspan="2">Ações</th>
                    </tr>
                    <tr>
                        <th class="th-search"><input class="form-control" id="srcUsername" type="text"></th>
                        <th class="th-search"><input class="form-control" id="srcLogin" type="text"></th>
                        <th class="th-search"><input class="form-control" id="srcEmail" type="text"></th>
                        <th class="th-search"><input class="form-control" id="srcProfile" type="text"></th>
                        <th class="th-search" colspan="2"></th>
                    </tr>
                </thead>

                <tbody class="users-tbody">
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
                        <td><a href="users-edit.php?id=<?php echo $dados['id']; ?>" class="btn btn-primary"><ion-icon name="create-outline"></ion-icon></a></td>
                        <td><a data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $dados['id']; ?>" class="btn btn-danger"><ion-icon name="trash-outline"></ion-icon></a></td>
                    </tr>
                    
                    

                    <!-- Modal -->
                    <div class="modal fade" id="deleteModal<?php echo $dados['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $dados['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel<?php echo $dados['id']; ?>">OPA! CALMA LÁ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Tem certeza que deseja excluir o usuário <strong><?php echo $dados['username'] ?></strong>? </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
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
            <a href="users-add.php" class="btn btn-addusers btn-success"><ion-icon name="person-add-outline"></ion-icon> Adicionar usuário</a>
        </div>
    </div>



<?php 
    include_once '../includes/footer.php';
?>