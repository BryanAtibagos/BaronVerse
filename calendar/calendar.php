<?php 
require_once __DIR__ . '/../header.php';   
?>
<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='utf-8' />
  <link href='lib/main.css' rel='stylesheet' />
  <script src='lib/main.js'></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        dayMaxEvents: true,
        editable: true,
        googleCalendarApiKey: 'AIzaSyC55Jn1vKfCgX6CpJlj3DjGPMoZNFzA2KY',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        height: 800,
        contentHeight: 780,
        aspectRatio: 3,
        eventSources: [{
            googleCalendarId: 'organicsph.it@gmail.com',
            className: 'oph',
          },
          {
            googleCalendarId: '5517b6b1ba4291e831b19f77c2c371729f175b763f5fa5e38800b082b863f392@group.calendar.google.com',
            className: 'nice-event',
            color: 'green',
          }
        ],
      });
      calendar.render();
    });
  </script>
</head>
<br><br><br>
<body class="body">
  <div style="padding-bottom: 2.5rem;">
    <div class="calendar" id='calendar'></div>
  </div>

</body>

</html>