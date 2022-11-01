<?php 
    session_start();
    if(isset($_SESSION['mensagem'])){
        echo $_SESSION['mensagem'];
    }
    session_unset();


    include_once 'php_action/db_connect.php';

    include_once __DIR__.'/includes/header.php';
?>

    <div class="row no-gutters mt-4">
        <div class="col-12 col-md-8 offset-md-2">
            <h3 class="text-center">CENTRAL DE SUPORTE | Cadastro de Colaboradores</h3>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Unidade</th>
                        <th>Departamento</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Ramal</th>
                        <th>Aniversário</th>
                        <th class="text-center" colspan="2">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                        // Realizando o select e atribuindo a uma variável
                        $sql = "SELECT * FROM colaboradores";
                        
                        $resultado = mysqli_query($connect, $sql);

                        if(mysqli_num_rows($resultado) > 0):

                        // Enquanto (dados = a quantidade de resultados retornados)
                        while($dados = mysqli_fetch_array($resultado)):
                    ?>
                    <tr>
                        <td><?php echo $dados['unity']; ?></td>
                        <td><?php echo $dados['department']; ?></td>
                        <td><?php echo $dados['fullname']; ?></td>
                        <td><?php echo $dados['email']; ?></td>
                        <td><?php echo $dados['phone']; ?></td>
                        <td><?php echo date('d/m', strtotime($dados['birth'])) ?></td>
                        <td><a href="editar.php?id=<?php echo $dados['id']; ?>" class="btn btn-primary">Editar</a></td>
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
                            <p>Tem certeza que deseja excluir o colaborador <strong><?php echo $dados['fullname'] ?></strong> </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <form action="php_action/delete.php" method="POST">
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
            <a href="adicionar.php" class="btn btn-success">Adicionar colaborador</a>
        </div>
    </div>


<?php 

    include_once __DIR__.'/includes/footer.php';
?>
