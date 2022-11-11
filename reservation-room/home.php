<?php

    require_once 'php_action/db_connect.php';

    session_start();

    if(!isset($_SESSION['logado'])):
        header('Location: index.php');
    endif;

    /* Captura dados da sessão */

    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin | Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="assets/lib/main.min.css" rel="stylesheet">
    <script src="assets/lib/main.min.js"></script>
</head>
<body id="admin-panel">

    <h1>Bem vindo(a), <?php echo $dados['username']; ?>!</h1>
    <p>Este é o módulo de Reserva de Sala de Reuniões, utilize o calendário abaixo para agendar uma reunião</p>

    <br>

    <!-- Gera o calendário do FullCalendar -->
    <div id="calendar"></div>

    <!-- Modal de Cadastro de Reserva -->
    <div class="modal fade" id="newReservation" tabindex="-1" role="dialog" aria-labelledby="newReservationLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="newReservationLabel">NOVA RESERVA!</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <span id="msg-cad"></span>
            <!-- INÍCIO DO FORMULÁRIO DE CADASTRO DE RESERVA -->
            <form action="php_action/create-reservation.php" method="POST" enctype="multipart/form-data">
                
                <input type="hidden" name="hostid" id="hostid" value="<?php echo $dados['id']; ?>">

                <div class="form-group">
                    <label for="title">Título</label>
                    <input id="title" name="title" class="form-control" required type="text" placeholder="Título da Reunião">
                </div>
                
                <div class="form-group">
                    <label for="host">Anfitrião</label>
                    <input id="host" name="host" class="form-control" required type="text" placeholder="Quem está agendando a reunião?">
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input id="email" name="email" class="form-control" required type="email" placeholder="example@company.com.br">
                </div>

                <div class="form-group">
                    <label for="guests">Convidados</label>
                    <input type="email" list="emails" id="guests" name="guests" class="form-control" multiple>
                    <datalist id="emails">
                        <?php 
                            $sqlguests = "SELECT * FROM colaboradores";
                            $resultguests = mysqli_query($connect, $sqlguests);

                            if(mysqli_num_rows($resultguests) > 0) :

                            while($dadosguests = mysqli_fetch_array($resultguests)):
                        ?>
                            <option value="<?php echo $dadosguests['email'] ?>"><?php echo $dadosguests['email'] ?></option>
                        <?php
                            endwhile;
                            else : ?>
                            <option selected disabled>Não existem colaboradores cadastrados</option>
                        <?php
                            endif;    
                        ?>
                    </datalist>
                </div>

                <div class="form-group">
                    <label for="rooms">Escolha a sua sala</label>
                    <fieldset id="rooms">
                        <div class="form-group row no-gutters">
                            <div class="room-card col-4">
                                <input type="radio" name="rooms" hidden id="carreta" value="Carreta">
                                <label for="carreta">Carreta</label>
                            </div>

                            <div class="room-card col-4">
                                <input type="radio" name="rooms" hidden id="vuc" value="VUC">
                                <label for="vuc">VUC</label>
                            </div>

                            <div class="room-card col-4">
                                <input type="radio" name="rooms" hidden id="toco" value="Toco">
                                <label for="toco">Toco</label>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div class="form-group">
                    <label for="start">Início</label>
                    <input required type="text" class="form-control data-hora" name="start" id="start" required>
                </div>

                <div class="form-group">
                    <label for="end">Término</label>
                    <input required type="text" class="form-control data-hora" name="end" id="end" required>
                  
                </div>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success">Reservar</button>
            </form> <!-- FIM DO FORMULÁRIO DE CADASTRO DE RESERVA -->
        </div>
        </div>
    </div>
    </div>

    
    

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
        $('.data-hora').mask('00/00/0000 00:00');

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
<script src="assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


</body>
</html>