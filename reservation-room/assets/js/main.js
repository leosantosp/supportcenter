document.addEventListener("DOMContentLoaded", function(){
    
    // Calendar render
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        
        dayMaxEventsRow: true,
        
        views: {
            timeGrid: {
                dayMaxEventRows: 3
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
        
        themeSystem: 'litera',

        locale: 'pt-br',
        events: {
            url: 'reservations-list.php',
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


    });

    calendar.render();
    // End of Calendar render



    




})