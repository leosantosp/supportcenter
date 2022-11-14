document.addEventListener("DOMContentLoaded", function(){
    
    // Calendar render
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',

        dayMaxEventRows: true, // for all non-TimeGrid views
        views: {
            timeGrid: {
            dayMaxEventRows: 3 // adjust to 6 only for timeGridWeek/timeGridDay
            }
        },

        businessHours: {
            daysOfWeek: [1,2,3,4,5],
            startTime: '07:00',
            endTime: '18:00'
        },
        slotDuration: '01:00',
        headerToolbar: {
            left: 'prev, next, today',
            center: 'title',
            right: 'dayGridMonth, timeGridDay'
        },

        themeSystem: 'bootstrap5',



        locale: 'pt-br',
        events: {
            url: 'php_action/list-reservation.php',
            cache: true,
        },


        // Habilitando para clicar em um dos dias
        selectable: true,

        //Abrindo um modal para cadastrar uma nova reserva
        select: function(info){
            $('#newReservation #start').val(info.start.toLocaleString());
            $('#newReservation #end').val(info.start.toLocaleString());
            $('#newReservation').modal('show');
        },

        // Função ao clicar em cima do evento, mostrar o modal com as informações
        eventClick: function(info){
            $('#deleteReservation').attr("href", "php_action/delete-reservation.php?id=" + info.event.id + "&hostid=" + info.event._def.extendedProps.hostid);
            info.jsEvent.preventDefault();

            /* RECEBENDO OS DADOS */
            $('#viewReservationOwner #id').text(info.event.id);
            $('#viewReservationOwner #hostid').text(info.event._def.extendedProps.hostid);
            $('#viewReservationOwner #title').text(info.event.title);
            $('#viewReservationOwner #host').text(info.event._def.extendedProps.host);
            $('#viewReservationOwner #email').text(info.event._def.extendedProps.email);
            $('#viewReservationOwner #guests').text(info.event._def.extendedProps.guests);
            $('#viewReservationOwner #room').text(info.event._def.extendedProps.room);
            $('#viewReservationOwner #start').text(info.event.start.toLocaleString());
            $('#viewReservationOwner #end').text(info.event.end.toLocaleString());

            /* INSERINDO OS DADOS NO FORMULÁRIO DE EDIÇÃO */
            $('#viewReservationOwner #id').val(info.event.id);
            $('#viewReservationOwner #hostid').val(info.event._def.extendedProps.hostid);
            $('#viewReservationOwner #title').val(info.event.title);
            $('#viewReservationOwner #host').val(info.event._def.extendedProps.host);
            $('#viewReservationOwner #email').val(info.event._def.extendedProps.email);
            $('#viewReservationOwner #room').val(info.event._def.extendedProps.room);
            $('#viewReservationOwner #start').val(info.event.start.toLocaleString());
            $('#viewReservationOwner #end').val(info.event.end.toLocaleString());

            $('#viewReservationOwner').modal('show');
        }


    });

    calendar.render();
    // End of Calendar render

});

$(document).ready(function(){

    $("#addreservation").on("submit", function(event){
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: "php_action/create-reservation.php",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(retorna){
                if(retorna['sit']){
                    document.location.reload(true);
                } else {
                    $("#msg-cad").html(retorna['msg']);
                }
            }
        });
    });

    $('.btnUpdate').on("click", function(){
        $('.viewReservationOwner').slideToggle();
        $('.editReservationOwner').slideToggle();
    });

    $('.btnCancelUpdate').on("click", function(){
        $('.editReservationOwner').slideToggle();
        $('.viewReservationOwner').slideToggle();
    });


    $("#editreservation").on("submit", function(event){
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: "php_action/update-reservation.php",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(){
                if(retorna['sit']){
                    document.location.reload(true);
                } else {
                    $("#msg-cad").html(retorna['msg']);
                }
            }
        });
    });

    
    $('.btnUpdateConfirm').on("click", function(){
        location.reload();
    });

});


