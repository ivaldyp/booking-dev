$(function () {
  /* initialize the calendar
   -----------------------------------------------------------------*/
  //Date for the calendar events (dummy data)
  // var bookings;

  // var events = [];
  // $.each(data.bookings, function( index, value ) {
  //   events.push({ title: data.bookings.booking_judul, start: new Date(2019, 7, 20, 10, 0), backgroundColor: "#0073b7", borderColor: "#0073b7"});
  // }); 

  // $.post("ajax/test.html", function( data ) {
  //           $( ".result" ).html( data );
  //       });

  var date = new Date();
  var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear();
  $('#calendar').fullCalendar({
    defaultView: 'listWeek',
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay'
    },
    buttonText: {
      today: 'today',
      month: 'month',
      week: 'week',
      day: 'day'
    }
    // ,
    // eventClick: function(info) {
    //   var eventObj = info.event;

    //   if (eventObj) {
    //     alert(
    //       'Clicked ' + eventObj.title + '.\n'
    //       // 'Will open ' + eventObj.url + ' in a new tab'
    //     );

    //     // window.open(eventObj.url);

    //     info.jsEvent.preventDefault(); // prevents browser from following link in current tab.
    //   } else {
    //     alert('Clicked ' + eventObj.title);
    //   }
    // },
  });

  var datas;
  // var newEvent = [];
  $.ajax({
    url: "/home/read",
    type: "get",
    success: function(data){
      datas = data.bookings;
      for(var i=0; i<datas.length; i++)
      {
        // newEvent.push({ title:datas[i].booking_judul, allDay: true });
        var newEvent = {
          title: datas[i].booking_judul,
          start: (datas[i].booking_date + " " + datas[i].time_startname),
          end: (datas[i].booking_date + " " + datas[i].time_endname)
        };
        $('#calendar').fullCalendar( 'renderEvent', newEvent , 'stick');  
        

      }
    }
  });

    // Random default events
    // events: [
    //   {
    //     title: "all day",
    //     start: new Date(y, m, 20),
    //     allDay: true,
    //     backgroundColor: 'blue', //red
    //     borderColor: 'blue' //red
    //   }
    // ],
    // events: eventsss,
    // events: [
    //     {
    //       title: 'All Day Event',
    //       start: new Date(y, m, 1),
    //       backgroundColor: "#f56954", //red
    //       borderColor: "#f56954" //red
    //     },
    //     {
    //       title: 'Long Event',
    //       start: new Date(y, m, d - 5),
    //       end: new Date(y, m, d - 2),
    //       backgroundColor: "#f39c12", //yellow
    //       borderColor: "#f39c12" //yellow
    //     },
    //     {
    //       title: 'Meeting',
    //       start: new Date(y, m, d, 10, 30),
    //       allDay: false,
    //       backgroundColor: "#0073b7", //Blue
    //       borderColor: "#0073b7" //Blue
    //     },
    //     {
    //       title: 'Lunch',
    //       start: new Date(y, m, d, 12, 0),
    //       end: new Date(y, m, d, 14, 0),
    //       allDay: false,
    //       backgroundColor: "#00c0ef", //Info (aqua)
    //       borderColor: "#00c0ef" //Info (aqua)
    //     },
    //     {
    //       title: 'Birthday Party',
    //       start: new Date(y, m, d + 1, 19, 0),
    //       end: new Date(y, m, d + 1, 22, 30),
    //       allDay: false,
    //       backgroundColor: "#00a65a", //Success (green)
    //       borderColor: "#00a65a" //Success (green)
    //     },
    //     {
    //       title: 'Click for Google',
    //       start: new Date(y, m, 28),
    //       end: new Date(y, m, 29),
    //       url: 'http://google.com/',
    //       backgroundColor: "#3c8dbc", //Primary (light-blue)
    //       borderColor: "#3c8dbc" //Primary (light-blue)
    //     }
    //   ],

    // editable: true,
    // droppable: true, // this allows things to be dropped onto the calendar !!!
    // drop: function (date, allDay) { // this function is called when something is dropped

    //   // retrieve the dropped element's stored Event Object
    //   var originalEventObject = $(this).data('eventObject');

    //   // we need to copy it, so that multiple events don't have a reference to the same object
    //   var copiedEventObject = $.extend({}, originalEventObject);

    //   // assign it the date that was reported
    //   copiedEventObject.start = date;
    //   copiedEventObject.allDay = allDay;
    //   copiedEventObject.backgroundColor = $(this).css("background-color");
    //   copiedEventObject.borderColor = $(this).css("border-color");

    //   // render the event on the calendar
    //   // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
    //   $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

    //   // is the "remove after drop" checkbox checked?
    //   if ($('#drop-remove').is(':checked')) {
    //     // if so, remove the element from the "Draggable Events" list
    //     $(this).remove();
    //   }

    // }
});