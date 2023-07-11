<?php 
    $titlepage = "Editar perfil | Helpdesk VIPEX";
    include_once '../includes/header.php';

?>

<div class="row no-gutters mt-4">
    <div class="col-12 col-md-8 offset-md-2">
        <h3 class="text-center title-page">EDITAR PERFIL</h3>

        <form action="../php_action/update-info.php" method="POST">
            <input name="id" type="hidden" value="<?php echo $dados['id'] ?>">
            <div class="form-group mt-3">
                <label for="username"><strong>Nome de Exibição</strong></label>
                <input class="form-control" name="username" id="username" type="text" value="<?php echo $dados['username'] ?>">
            </div>

            <div class="form-group mt-3">
                <label for="login"><strong>Login</strong></label>
                <input class="form-control" name="login" id="login" type="text" value="<?php echo $dados['login'] ?>">
            </div>

            <div class="form-group mt-3">
                <label for="email"><strong>E-mail</strong></label>
                <input type="email" class="form-control" name="email" value="<?php echo $dados['email'] ?>">
            </div>

            <div class="form-group mt-3">
                <label for="password"><strong>Senha</strong></label>
                <input class="form-control" type="password" name="password" id="password" value="<?php echo $dados['password'] ?>">
                <input type="checkbox" onclick="revealPassword()"> Mostrar senha
            </div>

            <div class="form-group mt-3">
                <div class="row">
                    <div class="col">
                        <label class="label-login" for="pc"><strong>Máquina (Ex: VIPEXGRU000)</strong></label>
                        <input id="pc" name="pc" type="text" class="form-control" required value="<?php echo $dados['pc'] ?>">
                    </div>
                    <div class="col">
                        <label class="label-login" for="ramal"><strong>Ramal ou Fila</strong></label>
                        <input id="ramal" name="ramal" type="text" class="form-control" required value="<?php echo $dados['ramal'] ?>">
                    </div>
                </div>     
            </div>

            <div class="form-group mt-3">
                <div class="row">
                    <div class="col">
                        <label class="label-login" for="estabelecimento"> <strong>Estabelecimento</strong></label>
                        <select id="estabelecimento" name="estabelecimento" class="form-control" required>
                            <option selected disabled>Escolha uma unidade</option>
                            <option <?php if($dados['estabelecimento'] == "02 - RIO"){echo 'selected';} ?> value="02 - RIO">02 - RIO</option>
                            <option <?php if($dados['estabelecimento'] == "04 - CTB"){echo 'selected';} ?> value="04 - CTB">04 - CTB</option>
                            <option <?php if($dados['estabelecimento'] == "05 - BGV"){echo 'selected';} ?> value="05 - BGV">05 - BGV</option>
                            <option <?php if($dados['estabelecimento'] == "06 - LDA"){echo 'selected';} ?> value="06 - LDA">06 - LDA</option>
                            <option <?php if($dados['estabelecimento'] == "08 - MRG"){echo 'selected';} ?> value="08 - MRG">08 - MRG</option>
                            <option <?php if($dados['estabelecimento'] == "09 - FLN"){echo 'selected';} ?> value="09 - FLN">09 - FLN</option>
                            <option <?php if($dados['estabelecimento'] == "11 - GRU"){echo 'selected';} ?> value="11 - GRU">11 - GRU</option>
                            <option <?php if($dados['estabelecimento'] == "17 - BHZ"){echo 'selected';} ?> value="17 - BHZ">17 - BHZ</option>
                            <option <?php if($dados['estabelecimento'] == "19 - SUM"){echo 'selected';} ?> value="19 - SUM">19 - SUM</option>
                            <option <?php if($dados['estabelecimento'] == "20 - SSA"){echo 'selected';} ?> value="20 - SSA">20 - SSA</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="department"> <strong>Departamento</strong></label>
                        <select class="form-control" name="department" id="department" required>
                            <option selected disabled hidden>Escolha o departamento</option>
                            <option <?php if($dados['department'] == "Arquivo"){echo 'selected'; } ?> value="Arquivo">Arquivo</option>
                            <option <?php if($dados['department'] == "Operacional"){echo 'selected'; } ?> value="Operacional">Operacional</option>
                            <option <?php if($dados['department'] == "Recebimento"){echo 'selected'; } ?> value="Recebimento">Recebimento</option>
                            <option <?php if($dados['department'] == "Assistência"){echo 'selected'; } ?> value="Assistência">Assistência</option>
                            <option <?php if($dados['department'] == "Comercial ADM"){echo 'selected'; } ?> value="Comercial ADM">Comercial ADM</option>
                            <option <?php if($dados['department'] == "Comercial Vendas"){echo 'selected'; } ?> value="Comercial Vendas">Comercial Vendas</option>
                            <option <?php if($dados['department'] == "Comercial Cotação"){echo 'selected'; } ?> value="Comercial Cotação">Comercial Cotação</option>
                            <option <?php if($dados['department'] == "Comercial Monitoria"){echo 'selected'; } ?> value="Comercial Monitoria">Comercial Monitoria</option>
                            <option <?php if($dados['department'] == "Marketing"){echo 'selected'; } ?> value="Marketing">Marketing</option>
                            <option <?php if($dados['department'] == "SAC Rastreio"){echo 'selected'; } ?> value="SAC Rastreio">SAC Rastreio</option>
                            <option <?php if($dados['department'] == "SAC Coletas"){echo 'selected'; } ?> value="SAC Coletas">SAC Coletas</option>
                            <option <?php if($dados['department'] == "Financeiro"){echo 'selected'; } ?> value="Financeiro">Financeiro</option>
                            <option <?php if($dados['department'] == "Controladoria"){echo 'selected'; } ?> value="Controladoria">Controladoria</option>
                            <option <?php if($dados['department'] == "RH"){echo 'selected'; } ?> value="RH">RH</option>
                            <option <?php if($dados['department'] == "DP"){echo 'selected'; } ?> value="DP">DP</option>
                            <option <?php if($dados['department'] == "TI"){echo 'selected'; } ?> value="TI">TI</option>
                            <option <?php if($dados['department'] == "Gerencia"){echo 'selected'; } ?> value="Gerencia">Gerencia</option>
                            <option <?php if($dados['department'] == "Administrativo"){echo 'selected'; } ?> value="Administrativo">Administrativo</option>
                            <option <?php if($dados['department'] == "Frota"){echo 'selected'; } ?> value="Frota">Frota</option>
                            <option <?php if($dados['department'] == "Compras"){echo 'selected'; } ?> value="Compras">Compras</option>
                        </select>
                    </div>
                </div>
                
            </div>

            <div class="form-group mt-4">
                <button class="btn btn-primary btn-login" type="submit" name="btn-update">ATUALIZAR DADOS</button>
            </div>

        </form>
    </div>
</div>

<script>
        function revealPassword(){
            var x = document.getElementById("password");
            if (x.type === "password"){
                x.type = "text"
            } else {
                x.type = "password";
            }
        }
    </script>

<?php 
    include_once '../includes/footer.php';
?>