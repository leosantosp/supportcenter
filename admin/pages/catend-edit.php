<?php 

    // Realizando conexão com o banco de dados
    include '../php_action/db_connect.php';

    session_start(); // Iniciando a sessão

    // Verificando se existe a sessão 'logado'
    if(!isset($_SESSION['logado'])):
        header('Location: index.php');
    endif;

    // Captura de Dados da sessão Logado

    $id = $_SESSION['id_usuario']; // Atribuindo o id da sessão id_usuario a variável id
    $sql = "SELECT * FROM usuarios WHERE id = '$id'"; // Montando a query SQL

    $resultado = mysqli_query($connect, $sql); // Executando a query
    $dados = mysqli_fetch_array($resultado);

    include_once '../includes/header.php';

    // Se for passado alguma id via URL, execute a função
    if(isset($_GET['id'])){

        $id = mysqli_escape_string($connect, $_GET['id']);
        $sql = "SELECT * FROM catalogoenderecos WHERE id = '$id'";

        $resultado = mysqli_query($connect, $sql);
        $dados = mysqli_fetch_array($resultado);
    }

?>

<div class="row no-gutters mt-4">
        <div class="col-12 col-md-8 offset-md-2">
            <h3 class="text-center">CENTRAL DE SUPORTE | Editar Catalogo de Enderecos</h3>
            <form action="../php_action/update-catend.php" method="POST">
                <input name="id" type="hidden" value="<?php echo $dados['id'] ?>">
                <div class="form-group">
                    <label for="tratamento">Nome</label>
                    <input class="form-control" type="text" name="tratamento" id="tratamento" value="<?php echo $dados['tratamento'] ?>">
                </div>
                
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input class="form-control" type="email" name="email" id="email" value="<?php echo $dados['email'] ?>">
                </div>

                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input class="form-control" type="text" name="senha" id="senha" value="<?php echo $dados['senha'] ?>">
                </div>

                <div class="form-group">
                    <label for="cargo">Cargo</label>
                    <input class="form-control" type="text" name="cargo" id="cargo" value="<?php echo $dados['cargo'] ?>">
                </div>

                <div class="form-group">
                    <label for="empresa">Unidade</label>
                    <select class="form-control" name="empresa" id="empresa">
                        <option disabled hidden>Selecione uma unidade</option>
                        <option <?php if($dados['empresa'] == "VIP Transportes") {echo "selected";} ?> value="VIP Transportes">VIP Transporte</option>
                        <option <?php if($dados['empresa'] == "VIPEX") {echo "selected";} ?> value="VIPEX">VIPEX</option>
                        <option <?php if($dados['empresa'] == "VPX Logística") {echo "selected";} ?> value="VPX Logística">VPX Logística</option>
                    </select>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" name="btn-atualizar" class="btn btn-success">ATUALIZAR</button>
                    <a href="../home.php" class="btn btn-primary">VOLTAR</a>
                </div>
            </form>

            <br>
        </div>
    </div>


<?php 
    include_once '../includes/footer.php';  
?>