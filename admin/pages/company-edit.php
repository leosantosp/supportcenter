<?php

    // Conexão
    include_once '../php_action/db_connect.php';

    session_start();

    if(!isset($_SESSION['logado'])){
        header('Location: index.php');
    }

    // Captura de dados da sessão
    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";

    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);

    include_once '../includes/header.php';

    if(isset($_GET['id'])){
        $id = mysqli_escape_string($connect, $_GET['id']);
        $sql = "SELECT * FROM companys WHERE id = '$id'";

        $resultado = mysqli_query($connect, $sql);
        $dados = mysqli_fetch_array($resultado);
    }

?>

<div class="row no-gutters mt-4">
        <div class="col-12 col-md-8 offset-md-2">
            <h3 class="text-center">CENTRAL DE SUPORTE | Editar Empresa</h3>
            <form action="../php_action/update-company.php" method="POST">
                <input name="id" type="hidden" value="<?php echo $dados['id'] ?>">
                <div class="form-group">
                    <label for="compnumber">ID da Empresa</label>
                    <input class="form-control" type="text" name="compnumber" id="compnumber" value="<?php echo $dados['compnumber'] ?>">
                </div>

                <div class="form-group">
                    <label for="compname">Nome da Empresa</label>
                    <input class="form-control" type="text" name="compname" id="compname" value="<?php echo $dados['compname'] ?>">
                </div>

                <div class="form-group">
                    <label for="cnpj">CNPJ</label>
                    <input class="form-control" type="text" name="cnpj" id="cnpj" value="<?php echo $dados['cnpj'] ?>">
                </div>

                <div class="form-group">
                    <label for="phone">Telefone</label>
                    <input class="form-control" type="phone" name="phone" id="phone" value="<?php echo $dados['phone'] ?>">
                </div>

                <div class="form-group">
                    <label for="address">Endereço</label>
                    <input class="form-control" type="text" name="address" id="address" value="<?php echo $dados['address'] ?>">
                </div>

                <div class="form-group">
                    <label for="manager">Gestor</label>
                    <input class="form-control" type="text" name="manager" id="manager" value="<?php echo $dados['manager'] ?>">
                </div>

                <div class="form-group mt-3">
                    <button type="submit" name="btn-atualizar" class="btn btn-success">ATUALIZAR</button>
                    <a href="company-list.php" class="btn btn-primary">VOLTAR</a>
                </div>
            </form>

            <br>
        </div>
    </div>


<?php 
    include_once '../includes/footer.php';  
?>