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
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newReservationLabel"><ion-icon name="globe-outline"></ion-icon> NOVA RESERVA!</h5>
                <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><ion-icon name="close-outline"></ion-icon></span>
                </button>
            </div>
            <div class="modal-body">
                <span id="msg-cad"></span>
                <!-- INÍCIO DO FORMULÁRIO DE CADASTRO DE RESERVA -->
                <form id="addreservation" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="hostid" id="hostid" value="<?php echo $dados['id']; ?>">

                    <div class="form-group">
                        <label class="form-label" for="title">Título</label>
                        <input id="title" name="title" class="form-control" required type="text" placeholder="Título da Reunião">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="host">Anfitrião</label>
                        <input id="host" name="host" class="form-control" required type="text" placeholder="Quem está agendando a reunião?">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">E-mail</label>
                        <input id="email" name="email" class="form-control" required type="email" placeholder="exemplo@empresa.com.br">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="guests">Convidados</label>
                        <input type="email" list="emails" id="guests" name="guests" class="form-control" multiple placeholder="Após digitar um e-mail, utiliza o sinal de ',' para adicionar mais pessoas">
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
                        <label class="form-label" for="rooms">Escolha a sua sala</label>
                        <fieldset id="rooms">
                            <div class="form-group row no-gutters">
                                <div class="room-card col-4">
                                    <input type="radio" name="rooms" hidden id="carreta" value="Carreta">
                                    <label for="carreta" class="card">
                                        <img class="card-img-top" src="assets/images/sala-carreta.jpg" alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">CARRETA</h5>
                                            <p class="card-text">Uma das salas disponíveis na Matriz, utilizada para treinamento de pessoal e apresentações</p>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><strong>Localização:</strong> No início do corredor, perto da escada</li>
                                            <li class="list-group-item"><strong>Capacidade:</strong> 15 pessoas</li>
                                            <li class="list-group-item"><strong>Rede:</strong> 8 acessos</li>
                                            <li class="list-group-item"><strong>Diferenciais:</strong> Projetor / Lousa</li>
                                        </ul>
                                    </label>
                                </div>

                                <div class="room-card col-4">
                                    <input type="radio" name="rooms" hidden id="vuc" value="VUC">
                                    <label for="vuc" class="card">
                                        <img class="card-img-top" src="assets/images/sala-vuc.jpg" alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">VUC</h5>
                                            <p class="card-text">Uma das salas disponíveis na Matriz, utilizada para entrevistas / gravações / reuniões pequenas / audiências</p>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><strong>Localização:</strong> Ao lado da sala do CEO</li>
                                            <li class="list-group-item"><strong>Capacidade:</strong> 3 pessoas</li>
                                            <li class="list-group-item"><strong>Rede:</strong> 2 acessos</li>
                                        </ul>
                                    </label>
                                </div>

                                <div class="room-card col-4">
                                    <input type="radio" name="rooms" hidden id="truck" value="Truck">
                                    <label for="truck" class="card">
                                        <img class="card-img-top" src="assets/images/sala-truck.jpg" alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">TRUCK</h5>
                                            <p class="card-text">Uma das salas disponíveis na Matriz, utilizada para reuniões com cliente / gravações / reuniões de médio/grande porte</p>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><strong>Localização:</strong> Meio do corredor</li>
                                            <li class="list-group-item"><strong>Capacidade:</strong> 8 pessoas</li>
                                            <li class="list-group-item"><strong>Rede:</strong> 6 acessos</li>
                                            <li class="list-group-item"><strong>Diferenciais:</strong> Frigobar / TV 55" / Webcam e Mic dedicado</li>
                                        </ul>
                                    </label>
                                </div>

                            </div>
                        </fieldset>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="start">Início</label>
                        <input required type="text" class="form-control data-hora" name="start" id="start" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="end">Término</label>
                        <input required type="text" class="form-control data-hora" name="end" id="end" required>
                    
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><ion-icon name="close-circle-outline"></ion-icon> Cancelar</button>
                <button type="submit" class="btn btn-success"><ion-icon name="checkmark-circle-outline"></ion-icon> Reservar</button>
                </form> <!-- FIM DO FORMULÁRIO DE CADASTRO DE RESERVA -->
            </div>
            </div>
        </div>
    </div>

    <!-- Modal de Edição da Reserva -->
    <div class="modal fade" id="viewReservationOwner" tabindex="-1" role="dialog" aria-labelledby="viewReservationOwnerLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewReservationOwnerLabel">DETALHES DA RESERVA! #<span id="id"></span> </h5>
                <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><ion-icon name="close-outline"></ion-icon></span>
                </button>

            </div>
            <div class="modal-body">
                <span id="msg-edit">
                    
                </span>

                <!-- Content of ViewOwner -->
                <div class="viewReservationOwner">
                    <dl class="row">
                        <dt class="col-sm-3 detail-title">Título</dt>
                        <dd class="col-sm-9" id="title"></dd>
                        <hr>

                        <dt class="col-sm-3 detail-title">Anfitrião</dt>
                        <dd class="col-sm-9" id="host"></dd>
                        <hr>

                        <dt class="col-sm-3 detail-title">E-mail</dt>
                        <dd class="col-sm-9" id="email"></dd>
                        <hr>

                        <dt class="col-sm-3 detail-title">Sala Escolhida</dt>
                        <dd class="col-sm-9" id="room"></dd>
                        <hr>

                        <dt class="col-sm-3 detail-title">Início</dt>
                        <dd class="col-sm-9" id="start"></dd>
                        <hr>

                        <dt class="col-sm-3 detail-title">Término</dt>
                        <dd class="col-sm-9" id="end"></dd>
                    </dl>

                    <div class="button-form-group">
                        <div class="button-1">
                            <button type="button" class="btn btn-warning btnUpdate"><ion-icon name="create-outline"></ion-icon> Editar</button>
                        </div>
                        <div class="button-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </div>

                    

                </div>

                <!-- FORM EDIT -->
                <div class="editReservationOwner">
                

                        <!-- INÍCIO DO FORMULÁRIO DE CADASTRO DE RESERVA -->
                        <form id="editreservation" method="POST" enctype="multipart/form-data">

                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="hostid" id="hostid">
                            <input type="hidden" name="verified" id="verified" value="<?php echo $dados['id'] ?>">

                            <div class="form-group">
                                <label class="form-label" for="title">Título</label>
                                <input id="title" name="title" class="form-control" required type="text" placeholder="Título da Reunião">
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label" for="host">Anfitrião</label>
                                <input id="host" name="host" class="form-control" required type="text" placeholder="Quem está agendando a reunião?">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="email">E-mail</label>
                                <input id="email" name="email" class="form-control" required type="email" placeholder="example@company.com.br">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="start">Início</label>
                                <input required type="text" class="form-control data-hora" name="start" id="start">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="end">Término</label>
                                <input required type="text" class="form-control data-hora" name="end" id="end">
                            
                            </div>

                            <div class="form-group button-form-group">
                                <div class="buttons-section">
                                    <button type="submit" class="btn btn-success btnUpdateConfirm"><ion-icon name="cloud-upload-outline"></ion-icon> Atualizar</button>
                                </div>
                                <div class="buttons-section-cancel">
                                    <a id="deleteReservation" class="btn btn-danger"><ion-icon name="trash-outline"></ion-icon></a>
                                    <button type="button" class="btn btn-secondary btnCancelUpdate">Cancelar</button>
                                </div>
                                
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