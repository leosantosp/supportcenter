<?php 
    session_start();

    include_once 'admin/php_action/db_connect.php';

    include_once __DIR__.'/includes/header.php';

    if(isset($_GET['id'])){

        $id = mysqli_escape_string($connect, $_GET['id']);
        $sql = "SELECT * FROM errors WHERE id = '$id'";

        $resultado = mysqli_query($connect, $sql);
        $dados = mysqli_fetch_array($resultado);
    }
?>

<section class="page">
    <div class="container">
        <div class="row">
            <article class="col-12 page-info">
                <h2 class="page-title"><?php echo $dados['status'] . " - " . $dados['description'] ?></h2>

                <article class="page-text">
                    <p class="page-description"><?php echo $dados['solution'] ?></p>
                </article>
            </article>
        </div>
    </div>
</section>

<?php 

    include_once 'includes/footer.php';

?>  