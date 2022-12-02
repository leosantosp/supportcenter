<?php 
    session_start();
    if(isset($_SESSION['mensagem'])){
        echo $_SESSION['mensagem'];
    }
    session_unset();


    include_once 'admin/php_action/db_connect.php';

    include_once __DIR__.'/includes/header.php';
?>

    <section class="companys" style="margin-top: 75px">
        <div class="container" style="height: 100%;">
            <article class="row">
                <div class="col-12">
                    <div class="card-list row no-gutters">
                        <div class="div-intro">
                            <img class="img-fluid" style="width:300px" src="assets/images/undraw_conversation_re_c26v.svg" onload="SVGInject(this)" alt="">
                        </div>
                        
                    <?php 

                        $sql = "SELECT * FROM companys";

                        $resultado = mysqli_query($connect, $sql);

                        if(mysqli_num_rows($resultado) > 0):

                        while($dados = mysqli_fetch_array($resultado)):
                    
                    ?>
                    
                        <div class="card card-company col-sm-4">
                            <div class="card-body">
                                <h5 class="card-title"> <strong><?php echo $dados['compnumber'] ?> | <?php echo $dados['compname'] ?> </strong></h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong><ion-icon name="business"></ion-icon> CNPJ: </strong> <?php echo $dados['cnpj'] ?></li>
                                <li class="list-group-item"><strong><ion-icon name="call"></ion-icon> Phone: </strong> <?php echo $dados['phone'] ?></li>
                                <li class="list-group-item"><strong><ion-icon name="navigate"></ion-icon> Endereço: </strong> <?php echo $dados['address'] ?></li>
                                <li class="list-group-item"><strong><ion-icon name="person"></ion-icon> Gestor: </strong> <?php echo $dados['manager'] ?></li>
                            </ul>
                        </div>
                    <?php
                        endwhile; 
                        else : ?>
                        
                            <p>Não existem dados para serem exibidos</p>

                        <?php
                            endif;
                        ?>

                    </div>
                </div>
            </article>
        </div>
    </section>
<?php 

    include_once __DIR__.'/includes/footer.php';
?>
