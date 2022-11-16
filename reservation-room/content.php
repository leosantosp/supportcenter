<?php 

    include_once 'includes/header.php';

?>

<?php 
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
    ?>

    <br>

    <!-- Gera o calendário do FullCalendar -->
    <div id="calendar"></div>

    <!-- Modal de Cadastro de Reserva -->
    <div class="modal fade" id="newReservation" tabindex="-1" role="dialog" aria-labelledby="newReservationLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
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
                <form id="addreservation" method="POST" enctype="multipart/form-data">
                    
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
                                    <label for="carreta" class="card">
                                        <img class="card-img-top" src="..." alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">CARRETA</h5>
                                            <p class="card-text">Uma das salas da empresa, normalmente disponibilizada para treinamento de pessoal</p>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Localização: Lugar X</li>
                                            <li class="list-group-item">Capacidade: X pessoas</li>
                                            <li class="list-group-item">Pontos de Rede: X pontos</li>
                                        </ul>
                                    </label>
                                </div>

                                <div class="room-card col-4">
                                    <input type="radio" name="rooms" hidden id="vuc" value="VUC">
                                    <label for="vuc" class="card">
                                        <img class="card-img-top" src="..." alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">VUC</h5>
                                            <p class="card-text">Uma das salas da empresa, normalmente disponibilizada para treinamento de pessoal</p>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Localização: Lugar X</li>
                                            <li class="list-group-item">Capacidade: X pessoas</li>
                                            <li class="list-group-item">Pontos de Rede: X pontos</li>
                                        </ul>
                                    </label>
                                </div>

                                <div class="room-card col-4">
                                    <input type="radio" name="rooms" hidden id="toco" value="Toco">
                                    <label for="toco" class="card">
                                        <img class="card-img-top" src="..." alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">TOCO</h5>
                                            <p class="card-text">Uma das salas da empresa, normalmente disponibilizada para treinamento de pessoal</p>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Localização: Lugar X</li>
                                            <li class="list-group-item">Capacidade: X pessoas</li>
                                            <li class="list-group-item">Pontos de Rede: X pontos</li>
                                        </ul>
                                    </label>
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

    <!-- Modal de Visualização da Reserva -->
    <!-- <div class="modal fade" id="viewReservation" tabindex="-1" role="dialog" aria-labelledby="viewReservationLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewReservationLabel">DETALHES DA RESERVA! #<span id="id"></span> </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <dl class="row">
                    <dt class="col-sm-3">Título</dt>
                    <dd class="col-sm-9" id="title"></dd>
                    <hr>

                    <dt class="col-sm-3">Anfitrião</dt>
                    <dd class="col-sm-9" id="host"></dd>
                    <hr>

                    <dt class="col-sm-3">E-mail</dt>
                    <dd class="col-sm-9" id="email"></dd>
                    <hr>

                    <dt class="col-sm-3">Sala Escolhida</dt>
                    <dd class="col-sm-9" id="room"></dd>
                    <hr>

                    <dt class="col-sm-3">Início</dt>
                    <dd class="col-sm-9" id="start"></dd>
                    <hr>

                    <dt class="col-sm-3">Término</dt>
                    <dd class="col-sm-9" id="end"></dd>
                </dl>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
            </div>
        </div>
    </div> -->

    <!-- Modal de Edição da Reserva -->
    <div class="modal fade" id="viewReservationOwner" tabindex="-1" role="dialog" aria-labelledby="viewReservationOwnerLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewReservationOwnerLabel">DETALHES DA RESERVA! #<span id="id"></span> </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <span id="msg-edit">
                    
                </span>

                <!-- Content of ViewOwner -->
                <div class="viewReservationOwner">
                    <dl class="row">
                        <dt class="col-sm-3">Título</dt>
                        <dd class="col-sm-9" id="title"></dd>
                        <hr>

                        <dt class="col-sm-3">Anfitrião</dt>
                        <dd class="col-sm-9" id="host"></dd>
                        <hr>

                        <dt class="col-sm-3">E-mail</dt>
                        <dd class="col-sm-9" id="email"></dd>
                        <hr>

                        <dt class="col-sm-3">Sala Escolhida</dt>
                        <dd class="col-sm-9" id="room"></dd>
                        <hr>

                        <dt class="col-sm-3">Início</dt>
                        <dd class="col-sm-9" id="start"></dd>
                        <hr>

                        <dt class="col-sm-3">Término</dt>
                        <dd class="col-sm-9" id="end"></dd>
                    </dl>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-warning btnUpdate">Editar</button>

                </div>

                <!-- FORM EDIT -->
                <div class="editReservationOwner">
                

                        <!-- INÍCIO DO FORMULÁRIO DE CADASTRO DE RESERVA -->
                        <form id="editreservation" method="POST" enctype="multipart/form-data">

                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="hostid" id="hostid">
                            <input type="hidden" name="verified" id="verified" value="<?php echo $dados['id'] ?>">

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
                                <label for="start">Início</label>
                                <input required type="text" class="form-control data-hora" name="start" id="start">
                            </div>

                            <div class="form-group">
                                <label for="end">Término</label>
                                <input required type="text" class="form-control data-hora" name="end" id="end">
                            
                            </div>

                            <div class="form-group">
                                <button type="button" class="btn btn-secondary btnCancelUpdate">Cancelar</button>
                                <a id="deleteReservation" class="btn btn-danger">Excluir</a>
                                <button type="submit" class="btn btn-success btnUpdateConfirm">Atualizar</button>
                            </div>
                                
                        </form> <!-- FIM DO FORMULÁRIO DE CADASTRO DE RESERVA -->

                </div>
            </div>

            </div>
        </div>
    </div>

<?php 

    require_once 'includes/footer.php'; 

?>