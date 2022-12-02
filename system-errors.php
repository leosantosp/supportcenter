<?php 
    session_start();
    if(isset($_SESSION['mensagem'])){
        echo $_SESSION['mensagem'];
    }
    session_unset();


    include_once 'admin/php_action/db_connect.php';

    include_once __DIR__.'/includes/header.php';

   

    
?>

<section class="system-errors" style="margin-top: 75px">
    <div class="container" style="height: 100%">
        <div class="row">

            <article class="col-12 system-errors-title">
                <h2 class="errors-title">Alertas / Erros do SINTRA</h2>
                <p class="errors-description">Nesta tela, você pode conferir alguns alertas ou erros do sistema que podem ser resolvidos por você. 
                    Antes de acionar a equipe de T.I, favor verificar se a sua solução encontra-se abaixo.</p>
            </article>
            
            <article class="col-12 system-errors-list">
                
                <table id="table" class="table table-cds">
                    <thead class="thead-table">
                        <tr>
                            <th class="th-title">ERRO / STATUS</th>
                            <th class="th-title">DESCRIÇÃO</th>
                            <th class="th-title">COMO RESOLVER?</th>
                        </tr>
                        <tr>
                            <th class="th-search"><input type="text" class="form-control"></th>
                            <th class="th-search"><input type="text" class="form-control"></th>
                            <th class="th-search"></th>
                        </tr>
                    </thead>
                    <tbody class="tbody-table">

                    <?php 
                         $sql = "SELECT * FROM errors";
                         $resultado = mysqli_query($connect, $sql);
                         
                         if(mysqli_num_rows($resultado) > 0):

                        while($dados = mysqli_fetch_array($resultado)):
                    ?>

                        <tr>
                            <td> <?php echo $dados['status'] ?></td>
                            <td><?php echo $dados['description'] ?></td>
                            <td><a class="btn-showmore" href="page-system.php?id=<?php echo $dados['id'] ?>">Clique aqui</a></td>
                        </tr>

                    <?php 
                        endwhile;
                    else: 
                    ?>
                        <tr>
                            <td colspan="3" class="text-center">Não existem erros cadastrados nesta página.</td>
                        </tr>
                    <?php 
                        endif;
                    ?>

                    </tbody>
                </table>

                
            </article>

        </div>
    </div>
</section>


<?php 

    include_once __DIR__.'/includes/footer.php';
?>
