document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      dayMaxEventRows: true, // for all non-TimeGrid views
      views: {
        timeGrid: {
          dayMaxEventRows: 3 // adjust to 6 only for timeGridWeek/timeGridDay
        }
      },
      businessHours: {
        daysOfWeek: [1, 2, 3, 4, 5],
        startTime: '07:00',
        endTime: '18:00'
      },
      slotDuration: '01:00',
      initialView: 'dayGridMonth',
      headerToolbar: {
          left:  'prev,next,today',
          center: 'title',
          right: 'dayGridMonth,timeGridDay'
      },
      locale: 'pt-br',
      events: {
        url: 'myfeed.php',
        cache: true,
      },
    
      /* ABRINDO EVENTOS QUANDO CLICAR SOBRE O EVENTO */
      eventClick: function(info) {
        $('#apagar_evento').attr("href", "delete-reservation.php?id=" + info.event.id);
        info.jsEvent.preventDefault();

        $('#visualizar #id').text(info.event.id);
        $('#visualizar #title').text(info.event.title);
        $('#visualizar #host').text(info.event.host);
        $('#visualizar #email').text(info.event.email);
        $('#visualizar #guests').text(info.event._def.extendedProps.guests);
        $('#visualizar #room').text(info.event._def.extendedProps.room);
        $('#visualizar #start').text(info.event.start.toLocaleString());
        $('#visualizar #end').text(info.event.end.toLocaleString());

        $('#visualizar').modal('show');
      }, 

      selectable: true,
      select: function(info) {
        // alert('Início da Reunião ' + info.start.toLocaleString());
        $('#cadastrar #start').val(info.start.toLocaleString());
        $('#cadastrar #end').val(info.start.toLocaleString());
        $('#cadastrar').modal('show');
      },

    });

    calendar.render();

});

  function DataHora(evento, objeto) {
      var keypress = (window.event) ? event.keyCode : evento.which;
      campo = eval(objeto);

      if (campo.value == '00/00/0000 00:00:00') {
          campo.value = "";
      }

      caracteres = '0123456789';
      separacao1 = '/';
      separacao2 = ' ';
      separacao3 = ':';
      conjunto1 = 2;
      conjunto2 = 5;
      conjunto3 = 10;
      conjunto4 = 13;
      conjunto5 = 16;

      if((caracteres.search(String.fromCharCode(keypress)) != -1) && campo.value.length < (19)) {
          if(campo.value.length == conjunto1)
            campo.value = campo.value + separacao1;

          else if (campo.value.length == conjunto2)
            campo.value = campo.value + separacao1;

          else if (campo.value.length == conjunto3)
            campo.value = campo.value + separacao2;

          else if (campo.value.length == conjunto4)
            campo.value = campo.value + separacao3;

          else if (campo.value.length == conjunto5)
            campo.value = campo.value + separacao3;
      } else {
        event.returnValue = false;
      }

  }

$(document).ready(function() {

    $("#addevent").on("submit", function(event){
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: "create-reservation.php",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(retorna){
                if(retorna['sit']){
                  location.reload();
                } else{
                    $("#msg-cad").html(retorna['mensagem']);
                }
            }
        })
    });

})