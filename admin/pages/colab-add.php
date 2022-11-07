<?php 
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
?>

    <div class="row no-gutters">
        <div class="col-12 col-md-8 offset-md-2">
            <h3>Novo Colaborador</h3>
            <form action="../php_action/create-colab.php" method="POST">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input class="form-control" type="text" name="nome" id="nome">
                </div>

                <div class="form-group">
                    <label for="department">Departamento</label>
                    <select class="form-control" name="department" id="department">
                        <option selected disabled hidden>Selecione um departamento</option>
                        <option value="Operacional">Operacional</option>
                        <option value="Assistência">Assistência</option>
                        <option value="Comercial">Comercial</option>
                        <option value="SAC">SAC</option>
                        <option value="Financeiro">Financeiro</option>
                        <option value="Controladoria">Controladoria</option>
                        <option value="RH">RH</option>
                        <option value="DP">DP</option>
                        <option value="TI">TI</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input class="form-control" type="email" name="email" id="email">
                </div>

                <div class="form-group">
                    <label for="phone">Ramal</label>
                    <input class="form-control" type="phone" name="phone" id="phone">
                </div>

                <div class="form-group">
                    <label for="company">Unidade</label>
                    <select class="form-control" name="company" id="company">
                        <option selected disabled hidden>Selecione uma unidade</option>
                        <option value="02 - RIO">02 - RIO</option>
                        <option value="04 - CTB">04 - CTB</option>
                        <option value="05 - BGV">05 - BGV</option>
                        <option value="06 - LDA">06 - LDA</option>
                        <option value="08 - MRG">08 - MRG</option>
                        <option value="09 - FLN">09 - FLN</option>
                        <option value="11 - GRU">11 - GRU</option>
                        <option value="17 - BHZ">17 - BHZ</option>
                        <option value="19 - SUM">19 - SUM</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="birth">Aniversário</label>
                    <input class="form-control" type="date" name="birth" id="birth">
                </div>

                <div class="form-group mt-3">
                    <button type="submit" name="btn-cadastrar" class="btn btn-success">Cadastrar</button>
                    <a href="colab-list.php" class="btn btn-primary">Voltar</a>
                </div>
            </form>

            <br>
        </div>
    </div>


<?php 
    include_once '../includes/footer.php';
?>