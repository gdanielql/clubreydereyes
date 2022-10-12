<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>


  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-12">

  			<h1 class="page-header">Calendario de Eventos</h1>
        <p>Por favor seleccione la fecha en la que desea añadir o eliminar un evento.</p>

  		</div>
  	</div>

  <link href='lib/fullcalendar.min.css' rel='stylesheet'/>
  <link href='lib/fullcalendar.print.css' rel='stylesheet' media='print'/>
  <script src='lib/jquery.min.js'></script>
  <script src='lib/moment.min.js'></script>
  <script src='lib/jquery-ui.custom.min.js'></script>
  <script src='lib/fullcalendar.min.js'></script>

  <script>

    $(document).ready(function () {
      function fmt(date) {
        return date.format("YYYY-MM-DD HH:mm");

      }

      //Se inicializan las variables
      var date = new Date();
      var d = date.getDate();
      var m = date.getMonth();
      var y = date.getFullYear();

      var calendar = $('#calendar').fullCalendar({
        editable: true,
        header: {
          left: 'prev,next today',
          center: 'title',

        },

        events: "modules/events.php",

        // Convierte la variable allDay de string a booleano
        eventRender: function (event, element, view) {
          if (event.allDay === 'true') {
            event.allDay = true;
          } else {
            event.allDay = false;
          }
        },
        selectable: true,
        selectHelper: true,
        select: function (start, end, allDay) {
          //Se pregunta si desea añadir y se procede a guardar el nombre del título
          var title = prompt('Título del evento: ');
          if (title) {
            var start = fmt(start);
            var end = fmt(end);
            $.ajax({
              url: 'modules/add_events.php',
              data: 'title=' + title + '&start=' + start + '&end=' + end,
              type: "POST",
              success: function (json) {

              }
            });
            calendar.fullCalendar('renderEvent',
                {
                  title: title,
                  start: start,
                  end: end,
                  allDay: allDay
                },
                true
            );
          }
          calendar.fullCalendar('unselect');
        },

        //Se actualiza el evento si el usuario arrastra el evento
        editable: true,
        eventDrop: function (event, delta) {
          var start = fmt(event.start);
          var end = fmt(event.end);
          $.ajax({
            url: 'modules/update_events.php',
            data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
            type: "POST",
            success: function (json) {
              alert("Actualizado con éxito");
            }
          });
        },

        //Se elimina el evento si el usuario clickea en el título del evento.
        eventClick: function (event) {
          var decision = confirm("¿Quiere eliminar el evento?");
          if (decision) {
            $.ajax({
              type: "POST",
              url: "modules/delete_event.php",
              data: "&id=" + event.id,
              success: function (json) {
                $('#calendar').fullCalendar('removeEvents', event.id);

              }
            });


          }

        },
        eventResize: function (event) {
          var start = fmt(event.start);
          var end = fmt(event.end);
          $.ajax({
            url: 'modules/update_events.php',
            data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
            type: "POST",
            success: function (json) {
               alert("Actualizado con éxito");
            }
          });

        }

      });

    });

  </script>

</head>
<body>
<div id='calendar'>
</div>
</div>
</div>

</body>

</html>
    <?php include 'modules/calendarfooter.php';?>
