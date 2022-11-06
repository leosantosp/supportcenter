<?php 
    session_start();
    if(isset($_SESSION['mensagem'])){
        echo $_SESSION['mensagem'];
    }
    session_unset();


    include_once 'admin/php_action/db_connect.php';

    include_once __DIR__.'/includes/header.php';
?>

    <div class="row no-gutters mt-4">
        <div class="col-12 col-md-8 offset-md-2">
            <h3 class="text-center">CENTRAL DE SUPORTE | Lista de Contatos Internos</h3>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Unidade</th>
                        <th>Departamento</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Ramal</th>
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
                    </tr>

                    

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

            <a href="colab-excel.php">Baixar catálogo de endereços</a>
        </div>
    </div>


<?php 

    include_once __DIR__.'/includes/footer.php';
?>
