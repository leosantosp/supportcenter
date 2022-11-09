<?php

    session_start();
        if(isset($_SESSION['mensagem'])){
            echo $_SESSION['mensagem'];
        }
    session_unset();

    include_once 'includes/header.php'; // Inclua o arquivo header.php 

?>

<div class="row no-gutters">
        <div class="col-12 col-md-8 offset-md-2">
            <h3>Ouvidoria</h3>
            <form action="admin/php_action/create-ouvid.php" method="POST">
                
                <div class="form-group">
                    <label for="company">Filial</label>
                    <select name="company" id="company" class="form-control">
                        <option disabled hidden selected>Selecione uma unidade</option>
                        <option value="RIO">RIO</option>
                        <option value="CTB">CTB</option>
                        <option value="BGV">BGV</option>
                        <option value="LDA">LDA</option>
                        <option value="MRG">MRG</option>
                        <option value="FLN">FLN</option>
                        <option value="GRU">GRU</option>
                        <option value="BHZ">BHZ</option>
                        <option value="SUM">SUM</option>
                    </select>
                </div>
            
                <div class="form-group">
                    <label for="department">Departamento</label>
                    <select name="department" id="department" class="form-control">
                        <option disabled hidden selected>Selecione um departamento</option>
                        <option value="ADM - ASSISTÊNCIA">ADM - ASSISTÊNCIA</option>
                        <option value="ADM - COMERCIAL">ADM - COMERCIAL</option>
                        <option value="ADM - FILIAL">ADM - FILIAL</option>
                        <option value="ADM - FINANCEIRO">ADM - FINANCEIRO</option>
                        <option value="ADM - FROTA">ADM - FROTA</option>
                        <option value="ADM - QUALIDADE">ADM - QUALIDADE</option>
                        <option value="ADM - RH">ADM - RH</option>
                        <option value="ADM - SAC">ADM - SAC</option>
                        <option value="ADM - TI">ADM - TI</option>
                        <option value="OPE - ADM">OPE - ADM</option>
                        <option value="OPE - DEPÓSITO">OPE - DEPÓSITO</option>
                        <option value="OPE - EQUIPE DISTRIBUIÇÃO">OPE - EQUIPE DISTRIBUIÇÃO</option>
                        <option value="OPE - EQUIPE VIAGEM">OPE - EQUIPE VIAGEM</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Nome</label>
                    <input class="form-control" type="text" name="name" id="name" placeholder="Deixe vazio para Anônimo">
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input class="form-control" type="email" name="email" id="email" placeholder="Deixa vazio para Anônimo">
                </div>

                <div class="form-group">
                    <label for="phone">Ramal</label>
                    <input class="form-control" type="phone" name="phone" id="phone" placeholder="Deixe vazio para Anônimo">
                </div>

                <div class="form-group">
                    <label for="sector">Setor</label>
                    <input class="form-control" type="text" name="sector" id="sector" placeholder="Deixa vazio para Anônimo">
                </div>

                <div class="form-group">
                    <label for="notification">Tipo de Notificação</label>
                    <select class="form-control" name="notification" id="notification">
                        <option selected disabled hidden >Do que se trata?</option>
                        <option value="Reclamação">Reclamação</option>
                        <option value="Sugestão">Sugestão</option>
                        <option value="Elogio">Elogio</option>
                        <option value="Solicitação">Solicitação</option>
                        <option value="Denúncia">Denúncia</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="report">Relato</label>
                    <textarea name="report" id="report" class="form-control"></textarea>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" name="btn-cadastrar" class="btn btn-success">Enviar</button>
                </div>
            </form>

            <br>
        </div>
    </div>


<?php 
    include_once 'includes/footer.php';
?>