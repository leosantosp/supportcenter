<?php 
    $titlepage = "Colaboradores | Central de Suporte";
    session_start();
    if(isset($_SESSION['mensagem'])){
        echo $_SESSION['mensagem'];
    }
    session_unset();


    include_once 'admin/php_action/db_connect.php';

    include_once __DIR__.'/includes/header.php';
?>
<section class="colaborators" style="margin-top: 75px">  
    <div class="container" style="height:100%">  
        <div class="row">
            <div class="col-12">
                <div class="div-intro">
                    <img class="js-tilt img-fluid" style="width: 300px" src="assets/images/team-up.svg" onload="SVGInject(this)">
                </div>

                <a class="btn-excel" download href="assets/files/catalogo-de-enderecos.csv"><img src="assets/images/icon-excel.svg" alt="Baixar catálogo de endereços atualizado"></a>

                <table id="table" class="table table-cds">
                    <thead class="thead-dark thead-table">
                        <tr>
                            <th class="th-title">Unidade</th>
                            <th class="th-title">Departamento</th>
                            <th class="th-title">Nome</th>
                            <th class="th-title">E-mail</th>
                            <th class="th-title">Ramal</th>
                        </tr>
                        <tr>
                            <th class="th-search"><input class="form-control" id="srcCompany" type="text"></th>
                            <th class="th-search"><input class="form-control" id="srcDepartment" type="text"></th>
                            <th class="th-search"><input class="form-control" id="srcName" type="text"></th>
                            <th class="th-search"><input class="form-control" id="srcEmail" type="text"></th>
                            <th class="th-search"><input class="form-control" id="srcRamal" type="text"></th>
                        </tr>
                    </thead>

                    <tbody class="tbody-table">
                        <?php 
                            // Realizando o select e atribuindo a uma variável
                            $sql = "SELECT * FROM usuarios WHERE estabelecimento <> '' AND department <> '' ";
                            
                            $resultado = mysqli_query($connect, $sql);

                            if(mysqli_num_rows($resultado) > 0):

                            // Enquanto (dados = a quantidade de resultados retornados)
                            while($dados = mysqli_fetch_array($resultado)):
                        ?>
                        <tr>
                            <td><?php echo $dados['estabelecimento']; ?></td>
                            <td><?php echo $dados['department']; ?></td>
                            <td><?php echo $dados['username']; ?></td>
                            <td><?php echo $dados['email']; ?></td>
                            <td><?php echo $dados['ramal']; ?></td>
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

            </div>
        </div>
    </div>
</section>


<?php 

    include_once __DIR__.'/includes/footer.php';
?>
