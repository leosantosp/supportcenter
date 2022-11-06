<?php

    // Incluindo a conexão com o banco de dados
    include_once '../php_action/db_connect.php';

    session_start(); //Iniciando a sessão

    // Verificando se o usuário esta 'logado'
    if(!isset($_SESSION['logado'])):
        header('Location: index.php'); //Direciona para a tela de login
    endif;

    // Captura de dados referente a sessão, identificando quem é o usuário

    $id = $_SESSION['id_usuario']; // Atribua a variável ID, ao id_usuario da SESSÃO
    $sql = "SELECT * FROM usuarios WHERE id = '$id'"; // Query SQL para buscar os dados referente aquele usuário

    $resultado = mysqli_query($connect, $sql); // Atribua a variável resultado, o que for encontrado na query executada
    $dados = mysqli_fetch_array($resultado); // Atribua os resultados retornados e monte um array chamado $dados com os valores

    include_once '../includes/header.php'; // Inclua o arquivo header.php 

?>

<div class="row no-gutters">
        <div class="col-12 col-md-8 offset-md-2">
            <h3>Inserir novo endereço no catálogo</h3>
            <form action="../php_action/create-catend.php" method="POST">
                <div class="form-group">
                    <label for="tratamento">Nome</label>
                    <input class="form-control" type="text" name="tratamento" id="tratamento">
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input class="form-control" type="email" name="email" id="email">
                </div>

                <div class="form-group">
                    <label for="senha">Senha do E-mail</label>
                    <input class="form-control" type="text" name="senha" id="senha">
                </div>

                <div class="form-group">
                    <label for="cargo">Cargo</label>
                    <input class="form-control" type="text" name="cargo" id="cargo">
                </div>

                <div class="form-group">
                    <label for="empresa">Empresa</label>
                    <select class="form-control" name="empresa" id="empresa">
                        <option selected disabled hidden>Selecione uma unidade</option>
                        <option value="VIP Transportes">VIP</option>
                        <option value="VIPEX">VIPEX</option>
                        <option value="VPX Logísica">VPX</option>
                    </select>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" name="btn-cadastrar" class="btn btn-success">Cadastrar</button>
                    <a href="home.php" class="btn btn-primary">Voltar</a>
                </div>
            </form>

            <br>
        </div>
    </div>


<?php 
    include_once '../includes/footer.php';
?>