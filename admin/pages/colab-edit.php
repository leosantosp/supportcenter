<?php 
    // Conexão
    include_once '../php_action/db_connect.php';

    session_start();

    /**
     * Verificação
     */

    if(!isset($_SESSION['logado'])):
        header('Location: index.php');    
    endif;

    /**
     * Captura de dados da sessão
     */

    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";

    $resultado = mysqli_query($connect, $sql);

    $dados = mysqli_fetch_array($resultado);

    include_once '../includes/header.php';

    if(isset($_GET['id'])){
        // Pegar o ID que foi passado via URL
        $id = mysqli_escape_string($connect, $_GET['id']);

        $sql = "SELECT * FROM colaboradores WHERE id = '$id'";

        // Executar a Query e atribuir o resultado em $resultado
        $resultado = mysqli_query($connect, $sql);

        // Atribuir os valores das arrays em $dado;
        $dados = mysqli_fetch_array($resultado);
    }
?>

    <div class="row no-gutters mt-4">
        <div class="col-12 col-md-6 offset-md-1">
            <h3 class="editcolab-title text-center">EDITANDO COLABORADOR <strong><?php echo $dados['fullname'] ?></strong></h3>
            <form class="editcolab-form" action="../php_action/update-colab.php" method="POST">
                <input name="id" type="hidden" value="<?php echo $dados['id'] ?>">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input class="form-control" type="text" name="nome" id="nome" value="<?php echo $dados['fullname'] ?>">
                </div>

                <div class="form-group">
                    <label for="department">Departamento</label>
                    <select class="form-control" name="department" id="department">
                        <option <?php if($dados['department'] == "") {echo "selected";} ?> selected disabled hidden>Selecione um departamento</option>
                        <option <?php if($dados['department'] == "Operacional") {echo "selected";} ?> value="Operacional">Operacional</option>
                        <option <?php if($dados['department'] == "Assistência") {echo "selected";} ?> value="Assistência">Assistência</option>
                        <option <?php if($dados['department'] == "SAC Rastreio") {echo "selected";} ?> value="SAC Rastreio">SAC Rastreio</option>
                        <option <?php if($dados['department'] == "SAC Coletas") {echo "selected";} ?> value="SAC Coletas">SAC Coletas</option>
                        <option <?php if($dados['department'] == "Financeiro") {echo "selected";} ?> value="Financeiro">Financeiro</option>
                        <option <?php if($dados['department'] == "Cobrança") {echo "selected";} ?> value="Cobrança">Cobrança</option>
                        <option <?php if($dados['department'] == "Controladoria") {echo "selected";} ?> value="Controladoria">Controladoria</option>
                        <option <?php if($dados['department'] == "RH") {echo "selected";} ?> value="RH">RH</option>
                        <option <?php if($dados['department'] == "DP") {echo "selected";} ?> value="DP">DP</option>
                        <option <?php if($dados['department'] == "TI") {echo "selected";} ?> value="TI">TI</option>
                        <option <?php if($dados['department'] == "Arquivo") {echo "selected"; } ?> value="Arquivo">Arquivo</option>
                        <option <?php if($dados['department'] == "Gerencia") {echo "selected"; } ?> value="Gerencia">Gerencia</option>
                        <option <?php if($dados['department'] == "Administrativo") {echo "selected"; } ?> value="Administrativo">Administrativo</option>
                        <option <?php if($dados['department'] == "Frota") {echo "selected"; } ?> value="Frota">Frota</option>
                        <option <?php if($dados['department'] == "Comercial ADM") {echo "selected"; } ?> value="Comercial ADM">Comercial ADM</option>
                        <option <?php if($dados['department'] == "Marketing") {echo "selected"; } ?> value="Marketing">Marketing</option>
                        <option <?php if($dados['department'] == "Comercial Vendas") {echo "selected"; }  ?> value="Comercial Vendas">Comercial Vendas</option>
                        <option <?php if($dados['department'] == "Comercial Cotação") {echo "selected"; }  ?> value="Comercial Cotação">Comercial Cotação</option>
                        <option <?php if($dados['department'] == "Recebimento") {echo "selected"; }  ?> value="Recebimento">Recebimento</option>
                        <option <?php if($dados['department'] == "Compras") {echo "selected"; }  ?> value="Compras">Compras</option>



                    </select>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input class="form-control" type="email" name="email" id="email" value="<?php echo $dados['email'] ?>">
                </div>

                <div class="form-group">
                    <label for="phone">Ramal</label>
                    <input class="form-control" type="phone" name="phone" id="phone" value="<?php echo $dados['phone'] ?>">
                </div>

                <div class="form-group">
                    <label for="company">Unidade</label>
                    <select class="form-control" name="company" id="company">
                        <option disabled hidden>Selecione uma unidade</option>
                        <option <?php if($dados['company'] == "02 - RIO") {echo "selected";} ?> value="02 - RIO">02 - RIO</option>
                        <option <?php if($dados['company'] == "04 - CTB") {echo "selected";} ?> value="04 - CTB">04 - CTB</option>
                        <option <?php if($dados['company'] == "05 - BGV") {echo "selected";} ?> value="05 - BGV">05 - BGV</option>
                        <option <?php if($dados['company'] == "06 - LDA") {echo "selected";} ?> value="06 - LDA">06 - LDA</option>
                        <option <?php if($dados['company'] == "08 - MRG") {echo "selected";} ?> value="08 - MRG">08 - MRG</option>
                        <option <?php if($dados['company'] == "09 - FLN") {echo "selected";} ?> value="09 - FLN">09 - FLN</option>
                        <option <?php if($dados['company'] == "11 - GRU") {echo "selected";} ?> value="11 - GRU">11 - GRU</option>
                        <option <?php if($dados['company'] == "17 - BHZ") {echo "selected";} ?> value="17 - BHZ">17 - BHZ</option>
                        <option <?php if($dados['company'] == "19 - SUM") {echo "selected";} ?> value="19 - SUM">19 - SUM</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="birth">Aniversário</label>
                    <input class="form-control" type="date" name="birth" id="birth" value="<?php echo $dados['birth'] ?>">
                </div>

                <div class="form-group mt-3">
                    <button type="submit" name="btn-atualizar" class="btn btn-success"><ion-icon name="refresh-outline"></ion-icon> Atualizar</button>
                    <a href="colab-list.php" class="btn btn-primary"><ion-icon name="arrow-back-circle-outline"></ion-icon> Voltar</a>
                </div>
            </form>

            <br>
        </div>
    </div>


<?php 
    include_once '../includes/footer.php';  
?>