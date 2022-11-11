<?php 
session_start();
?>

<!DOCTYPE html>
<html lang='pt-br'>
  <head>
    <meta charset='utf-8'>
    <meta name="author" content="Leonardo dos Santos">
    <meta name="keywords" content="Agendamento de Sala de Reunião">
    <meta name="description" content="Reserve agora a Sala de Reunião">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href='lib/main.min.css' rel='stylesheet' />
    <link rel="stylesheet" href="style.css">
    <script src='lib/main.min.js'></script>
    <script src="lib/locales-all.min.js"></script>
  </head>
  <body>
  
    <!-- LOGO -->
    <div class="col-12 div-logo">
        <div class="row">
            <div class="container">
                <img class="logo" src="assets/images/logo.jpg" alt="VIPEX LOGO">
            </div>
        </div>
    </div>

    <?php 
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
?>

    <!-- CALENDÁRIO -->
    <div id='calendar'></div>



    <!-- MODAL -->
    <div class="modal fade" id="visualizar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">DETALHES DA RESERVA!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- Título da Reunião -->
                <dl class="row">

                    <dt class="col-sm-3">Título da Reunião</dt>
                    <dd class="col-sm-9" id="title"></dd>

                    <hr>
                    
                    <dt class="col-sm-3">Quem agendou?</dt>
                    <dd class="col-sm-9" id="nome"></dd>

                    <hr>

                    <dt class="col-sm-3">Contato</dt>
                    <dd class="col-sm-9" id="contato"></dd>

                    <hr>

                    <dt class="col-sm-3">Sala Escolhida</dt>
                    <dd class="col-sm-9" id="room"></dd>

                    <hr>


                    <dt class="col-sm-3">Início da Reunião</dt>
                    <dd class="col-sm-9" id="start"></dd>

                    <hr>


                    <dt class="col-sm-3">Término da Reunião</dt>
                    <dd class="col-sm-9" id="end"></dd>
                </dl>
            </div>
            <div class="modal-footer">
            <p class="p-warning">*OBS: Caso seja necessário equipamentos para a reunião (Ex: teclados, notebooks). 
                    Assim que for realizada a reserva, acesse o formulário de chamados e 
                    solicite o equipamento necessário. <br> A Equipe de TI da VIPEX Transportes agradece a compreensão*</p>
            </div>
            
            </div>
        </div>
    </div>

    <!-- MODAL CADASTRAR -->
    <div class="modal fade" id="cadastrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">RESERVAR A SALA DE REUNIÃO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span id="msg-cad"></span>
                <form id="addevent" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Título</label>
                        <div class="col-sm-10">
                            <input required type="text" class="form-control" name="title" id="title" placeholder="Digite um título para reunião">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nome</label>
                        <div class="col-sm-10">
                            <input required type="text" class="form-control" name="nome" id="nome" placeholder="Quem está agendando a reunião?">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Contato</label>
                        <div class="col-sm-10">
                            <input required type="text" class="form-control" name="contato" id="contato" placeholder="Digite um ramal ou e-mail para contato">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Sala</label>
                        <div class="col-sm-10">
                            <select required name="room" class="form-control" id="room">
                                <option value="" selected disabled>Selecione a Sala</option>
                                <option value="Toco">Toco</option>
                                <option value="Carreta">Carreta</option>
                                <option value="VUC">VUC</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Início</label>
                        <div class="col-sm-10">
                            <input required type="text" class="form-control data-hora" name="start" id="start">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Término</label>
                        <div class="col-sm-10">
                            <input required type="text" class="form-control data-hora" name="end" id="end">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                           <button type="submit" name="CadEvent" id="CadEvent" value="CadEvent" class="btn btn-success">RESERVAR</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <p class="p-warning">*OBS: Caso seja necessário equipamentos para a reunião (Ex: teclados, notebooks). 
                    Assim que for realizada a reserva, acesse o formulário de chamados e 
                    solicite o equipamento necessário. <br> A Equipe de TI da VIPEX Transportes agradece a compreensão*</p>
            </div>
            
            </div>
        </div>
    </div>
   

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script src="assets/js/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $('.data-hora').mask('00/00/0000 00:00:00');

        function dataformatada() {
            var hoje = new Date();
            var dd = hoje.getDate();
            var mm = hoje.getMonth()+1;
            var aaaa = hoje.getFullYear();
            var horas = hoje.getHours();
            var minutos = hoje.getMinutes();
            var segundos = hoje.getSeconds();
                if(dd<10){dd='0'+dd}
                if(mm<10){mm='0'+mm}
                if(horas<10){horas='0'+horas}
                if(minutos<10){minutos='0'+minutos}
                if(segundos<10){segundos='0'+segundos}
            return dd +'/'+ mm +'/'+ aaaa +' '+ horas +':'+ minutos +':'+ segundos;
        }

        function aplicahoras() {
        debugger;
        var campos = document.getElementsByClassName('data-hora'),
            i = campos.length;

        while(i < campos.length ) {
            campos[i].value = dataformatada();
        }
        }
    </script>
    
</body>
</html>