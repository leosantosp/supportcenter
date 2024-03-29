<?php
    include_once '../php_action/db_connect.php';

    session_start();

    /* Verificando a sessão 'logado' */
    if(!isset($_SESSION['logado'])){
        header('Location: index.php');
    }

    // Capturando dados da sessão
    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";

    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);

    include_once '../includes/header.php';

?>

<div class="row no-gutters">
        <div class="col-12 col-md-8 offset-md-2">
            <h3 class="page-title"><ion-icon name="business-outline"></ion-icon> Nova Empresa</h3>
            <form class="form-admin" action="../php_action/create-company.php" method="POST">
                <div class="form-group">
                    <label for="compnumber">ID da Unidade</label>
                    <input class="form-control" type="text" name="compnumber" id="compnumber">
                </div>

                <div class="form-group">
                    <label for="compname">Nome da Unidade</label>
                    <input class="form-control" type="text" name="compname" id="compname">
                </div>

                <div class="form-group">
                    <label for="cnpj">CNPJ</label>
                    <input class="form-control" type="text" name="cnpj" id="cnpj">
                </div>

                <div class="form-group">
                    <label for="ie">IE</label>
                    <input type="text" class="form-control" id="ie" name="ie">
                </div>

                <div class="form-group">
                    <label for="phone">Telefone</label>
                    <input class="form-control" type="phone" name="phone" id="phone">
                </div>

                <div class="form-group">
                    <label for="address">Endereço</label>
                    <input class="form-control" type="text" name="address" id="address">
                </div>

                <div class="form-group">
                    <label for="manager">Gestor</label>
                    <input class="form-control" type="text" name="manager" id="manager">
                </div>

                <div class="form-group mt-3">
                    <button type="submit" name="btn-cadastrar" class="btn btn-success"><ion-icon name="add-outline"></ion-icon> Cadastrar</button>
                    <a href="company-list.php" class="btn btn-primary"><ion-icon name="arrow-back-outline"></ion-icon> Voltar</a>
                </div>
            </form>

            <br>
        </div>
    </div>


<?php 
    include_once '../includes/footer.php';
?>