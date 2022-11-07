<?php

    // Conexão com o banco de dados
    include_once '../php_action/db_connect.php';

    session_start(); // Iniciando a sessão

    if(isset($_SESSION['mensagem'])){
        echo $_SESSION['mensagem'];
    }

    /**
     * Verificação se o usuário está 'logado'
     */

    if(!isset($_SESSION['logado'])){
        header('Location: index.php');
    }

    /** Captura dos dados da sessão 'logado' */
    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";

    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);

    include_once '../includes/header.php';

?>

<div class="row no-gutters mt-4">
        <div class="col-12 col-md-8 offset-md-2">
            <h3 class="text-center">CENTRAL DE SUPORTE | Cadastro de Empresas</h3>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CNPJ</th>
                        <th>Telefone</th>
                        <th>Endereço</th>
                        <th>Gestor</th>
                        <th class="text-center" colspan="2">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                        // Realizando o select e atribuindo a uma variável
                        $sql = "SELECT * FROM companys";
                        
                        $resultado = mysqli_query($connect, $sql);

                        if(mysqli_num_rows($resultado) > 0):

                        // Enquanto (dados = a quantidade de resultados retornados)
                        while($dados = mysqli_fetch_array($resultado)):
                    ?>
                    <tr>
                        <td><?php echo $dados['compnumber']; ?></td>
                        <td><?php echo $dados['compname']; ?></td>
                        <td><?php echo $dados['cnpj']; ?></td>
                        <td><?php echo $dados['phone']; ?></td>
                        <td><?php echo $dados['address']; ?></td>
                        <td><?php echo $dados['manager']; ?></td>
                        <td><a href="company-edit.php?id=<?php echo $dados['id']; ?>" class="btn btn-primary">Editar</a></td>
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
                            <p>Tem certeza que deseja excluir a empresa <strong><?php echo $dados['compname'] ?></strong>? </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <form action="../php_action/delete-company.php" method="POST">
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
            <a href="company-add.php" class="btn btn-success">Adicionar colaborador</a>
        </div>
    </div>


<?php 

    include_once '../includes/footer.php';
?>