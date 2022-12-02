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
        <div class="col-12 col-md-5 offset-md-1">
            <h3 class="addcolab-title"><ion-icon name="person-add-outline"></ion-icon> NOVO COLABORADOR</h3>
            <form class="addcolab-form" action="../php_action/create-colab.php" method="POST">
                <div class="form-group">
                    <label for="nome"><ion-icon name="person-outline"></ion-icon> Nome</label>
                    <input class="form-control" type="text" name="nome" id="nome">
                </div>

                <div class="form-group">
                    <label for="department"><ion-icon name="people-outline"></ion-icon> Departamento</label>
                    <select class="form-control" name="department" id="department">
                        <option selected disabled hidden>Selecione um departamento</option>
                        <option value="Arquivo">Arquivo</option>
                        <option value="Operacional">Operacional</option>
                        <option value="Recebimento">Recebimento</option>
                        <option value="Assistência">Assistência</option>
                        <option value="Comercial ADM">Comercial ADM</option>
                        <option value="Comercial Vendas">Comercial Vendas</option>
                        <option value="Comercial Cotação">Comercial Cotação</option>
                        <option value="Marketing">Marketing</option>
                        <option value="SAC Rastreio">SAC Rastreio</option>
                        <option value="SAC Coletas">SAC Coletas</option>
                        <option value="Financeiro">Financeiro</option>
                        <option value="Controladoria">Controladoria</option>
                        <option value="RH">RH</option>
                        <option value="DP">DP</option>
                        <option value="TI">TI</option>
                        <option value="Gerencia">Gerencia</option>
                        <option value="Administrativo">Administrativo</option>
                        <option value="Frota">Frota</option>
                        <option value="Compras">Compras</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="email"><ion-icon name="people-outline"></ion-icon> E-mail</label>
                    <input class="form-control" type="email" name="email" id="email">
                </div>

                <div class="form-group">
                    <label for="phone"><ion-icon name="call-outline"></ion-icon> Ramal</label>
                    <input class="form-control" type="phone" name="phone" id="phone">
                </div>

                <div class="form-group">
                    <label for="company"> <ion-icon name="git-branch-outline"></ion-icon> Unidade</label>
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
                    <label for="birth"><ion-icon name="calendar-number-outline"></ion-icon> Aniversário</label>
                    <input class="form-control" type="date" name="birth" id="birth">
                </div>

                <div class="form-group mt-3">
                    <button type="submit" name="btn-cadastrar" class="btn btn-success"><ion-icon name="add-circle-outline"></ion-icon> Adicionar</button>
                    <a href="colab-list.php" class="btn btn-primary"><ion-icon name="arrow-back-circle-outline"></ion-icon> Voltar</a>
                </div>
            </form>

            <br>
        </div>
    </div>


<?php 
    include_once '../includes/footer.php';
?>